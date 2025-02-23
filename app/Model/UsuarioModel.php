<?php

class UsuarioModel
{
    public static function getUserById(string $id)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT Id, Login, Name, Active, Created FROM users WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $usuario = $stmt->fetchObject('UsuarioModel');

            if (!$usuario) {
                new Exception('Usuário não encontrado');
                AutenticacaoController::Logoff();
            }

            Connection::closeConn();
            return $usuario;
        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar usuário: ' . $e->getMessage());
        }
    }

    public static function getAllUsers()
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT Id, Login, Name FROM users ORDER BY Id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = [];
            while ($row = $stmt->fetchObject('UsuarioModel')) {
                $result[] = $row;
            }

            if (empty($result)) {
                throw new Exception('Nenhum usuário encontrado');
            }
            
            Connection::closeConn();
            return $result;
        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar usuários: ' . $e->getMessage());
        }
    }

    public static function getFotoUsuarioById(string $id)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT ProfilePicture FROM users WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            $imagem = $stmt->fetchColumn();

            if ($imagem === false) {
                $retorno = false;
            }
            
            $retorno = "data:image/png;base64," . base64_encode($imagem);

            if ($retorno == "data:image/png;base64,") {
                $retorno = "";
            }

            Connection::closeConn();
            return $retorno;
        } catch (PDOException $e) {
            Connection::closeConn();
        }
    }

    public static function trocarFotoUsuario(string $id, string $base64) {
        $conn = Connection::getConn();
    
        try {
            $sql = "UPDATE users SET ProfilePicture = :base64 WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':base64', $base64, PDO::PARAM_STR);
            $stmt->execute();
    
            Connection::closeConn();
        } catch (PDOException $e) {
            error_log("Error updating profile picture: " . $e->getMessage());
            Connection::closeConn();
        }
    }
    
    public static function removerFotoUsuario(int $id) {
        $conn = Connection::getConn();
    
        try {
            $sql = "UPDATE users SET ProfilePicture = NULL WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            Connection::closeConn();
        } catch (PDOException $e) {
            error_log("Erro ao remover imagem do usuário " . $e->getMessage());
            Connection::closeConn();
        }
    }

    public static function trocarSenhaUsuario(string $id, string $senha, string $novaSenha) {
        $conn = Connection::getConn();
        header('Content-Type: application/json');
        try {
            $sql = "SELECT Password, Salt FROM users WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldSalted = $senha . $userData['Salt'];
            $newSalted = $novaSenha . $userData['Salt'];
            $options = [ 'cost' => 15, ];
            $hashed = password_hash($newSalted, PASSWORD_BCRYPT, $options);

            if (!$userData) {
                echo json_encode(['success' => false, 'message' => 'Usuário não encontrado!']);
                return;
            }
    
            if (!password_verify($oldSalted, $userData['Password'])) {
                echo json_encode(['success' => false, 'message' => 'Senha atual incorreta!']);
                return;
            }
    
            $sql = "UPDATE users SET Password = :novaSenha WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':novaSenha', $hashed, PDO::PARAM_STR);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'A senha foi alterada!']);
            return;
            
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erro ao alterar senha!']);
            return;
        } finally {
            Connection::closeConn();
        }
    }
    
    public static function Cadastrar(string $nome, string $email, string $senha)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT Login FROM users WHERE Login = :login";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':login', $email, PDO::PARAM_STR);
            $stmt->execute();

            $usuario = $stmt->fetchObject('UsuarioModel');

            if ($usuario) {
                throw new Exception('Esse e-mail ja foi cadastrado!');
            } else {
                $salt = bin2hex(random_bytes(16));

                if (strlen($senha) + strlen($salt) > 64) {
                    $salt = bin2hex(random_bytes(12));
                }
                
                $options = [ 'cost' => 15, ];
                $salted = $senha . $salt;
                $hashed = password_hash($salted, PASSWORD_BCRYPT, $options);
                $sql = "INSERT INTO users (Login, Name, Password, Salt, Active) VALUES (:login, :name, :password, :salt, 1)";
                $stmt = $conn->prepare($sql);   
                $stmt->bindParam(':login', $email, PDO::PARAM_STR);
                $stmt->bindParam(':name', $nome, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashed, PDO::PARAM_STR);
                $stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
                $stmt->execute();
            }

        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro: ' . $e->getMessage());
        }
    }
}

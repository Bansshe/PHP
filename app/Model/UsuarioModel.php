<?php

class UsuarioModel
{
    public static function getUserById(int $id)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT Id, Login, Name FROM users WHERE id = :id";
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
            $sql = "SELECT Id, Registro, Email, Nome, Tel, CPF, Ativo, CompanyId FROM users ORDER BY id DESC";
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

    public static function getFotoUsuarioById(int $id)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT ProfilePicture FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    public static function trocarFotoUsuario(int $id, string $base64) {
        $conn = Connection::getConn();
    
        try {
            $sql = "UPDATE users SET ProfilePicture = :base64 WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    public static function trocarSenhaUsuario(int $id, string $email, string $novaSenha) {
        $conn = Connection::getConn();
        header('Content-Type: application/json');
        try {
            $sql = "SELECT Password, Hash FROM users WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$userData) {
                echo json_encode(['success' => false, 'message' => 'Usuário não encontrado!']);
                return;
            }
    
            if (!password_verify($email, $userData['Password'])) {
                echo json_encode(['success' => false, 'message' => 'Senha atual incorreta!']);
                return;
            }
    
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    
            $sql = "UPDATE users SET Password = :novaSenha WHERE Id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':novaSenha', $novaSenhaHash, PDO::PARAM_STR);
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
    
}

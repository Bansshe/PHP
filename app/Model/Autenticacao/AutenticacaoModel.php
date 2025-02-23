<?php

class AutenticacaoModel
{
    public static function Login(string $login, string $senha) {

        $conn = Connection::getConn();
        header('Content-Type: application/json');
        try {
            $sql = "SELECT Id, Login, Password, Salt, Active FROM users WHERE Login = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $login, PDO::PARAM_STR);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $senha = $senha . $userData['Salt'];    

            if (!$userData || !password_verify($senha, $userData['Password'])) {
                echo json_encode(['success' => false, 'message' => 'Login ou senha incorretos!']);
                
                return;
            }

            if ($userData['Active'] != 1) 
            {
                echo json_encode(['success' => false, 'message' => 'Usuario inativo, entre em contato com seu administrador!']);

                return;
            }

            $_SESSION['id'] = $userData['Id'];
            
            echo json_encode(['success' => true, 'message' => 'Login efetuado!']);

            exit();
            
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Problema ao efetuar login!']);
            
            return;
        } finally {
            Connection::closeConn();
        }
    }

    public static function LoginOAuth(string $login) {
        $conn = Connection::getConn();

        header('Content-Type: application/json');

        try {
            $sql = "SELECT Id, Login, Active FROM users WHERE Login = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $login, PDO::PARAM_STR);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                echo json_encode(['success' => false, 'message' => 'Usuário não cadastrado.']);
                
                return;
            }

            if ($userData['Active'] != 1) 
            {
                echo json_encode(['success' => false, 'message' => 'Usuario inativo, entre em contato com seu administrador!']);

                return;
            }

            $_SESSION['id'] = $userData['Id'];
            
            echo json_encode(['success' => true, 'message' => 'Login efetuado!']);

            exit();
            
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Problema ao efetuar login!']);
            
            return;
        } finally {
            Connection::closeConn();
        }
    }

    public static function Logoff()
    {
        unset($_SESSION['id']);
        
        if ($_SESSION['id'] == "") {
            header("Location: /");
            exit();
        }
    }
}

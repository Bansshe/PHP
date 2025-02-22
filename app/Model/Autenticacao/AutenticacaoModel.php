<?php

class AutenticacaoModel
{
    public static function Login(string $login, string $senha) {

        $conn = Connection::getConn();
        header('Content-Type: application/json');
        try {
            $sql = "SELECT Password, Id FROM users WHERE Login = :login";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                echo json_encode(['success' => false, 'message' => 'Login ou senha incorretos!']);
                return;
            }

            if (!password_verify($senha, $userData['Password'])) {
                echo json_encode(['success' => false, 'message' => 'Login ou senha incorretos!']);
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

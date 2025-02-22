<?php

abstract class Connection
{
    private static ?PDO $conn = null;

    public static function getConn(): PDO
    {
        
        if (self::$conn === null) {

            switch($_SERVER['HTTP_HOST']) {
                case "app.bansshe.com.br":
                    $database = "u440102774_master";
                    $username = "u440102774_mbansshe";
                    $password = "K8=E]V*fSv$";
                    break;
                case "dev.bansshe.com.br":
                    $database = "u440102774_bansshe";
                    $username = "u440102774_bansshe";
                    $password = "czNYa3FnQEtaalYv";
                    break;
                case "127.0.0.1":
                    $database = "if0_38348229_bannshe";
                    $username = "root";
                    $password = "";
                    break;
                default:
                    $database = "u440102774_master";
                    $username = "u440102774_mbansshe";
                    $password = "K8=E]V*fSv$";
                    break;
            }

            $servername = "localhost";

            if($password != "") {
                $password = self::getDecryptedPassword($password);
            }

            try {
                self::$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Conexão falhou: " . $e->getMessage());
                echo "Não foi possível conectar com o banco de dados.";
                exit;
            }
        }

        return self::$conn;
        
    }

    private static function getDecryptedPassword($password): string
    {
        return base64_decode($password);
    }
    
    public static function closeConn(): void
    {
        self::$conn = null;
    }
}

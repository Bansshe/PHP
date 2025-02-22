<?php

class AutenticacaoController
{
    public static function Index()
    {
        if(!isset($_SESSION['id'])) {

            try {
                $loader = new \Twig\Loader\FilesystemLoader('app/View/Autenticacao');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('Index.html');
                $conteudo = $template->render();
                
                echo $conteudo;
                
            } catch (Exception $e) {
                echo json_encode(['Erro ' => $e->getMessage()]);
            }
        } else {
            header("Location: /");
        }
        exit();
    }

    public static function Login()
    {
        try {
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                
                if($email && $senha) {
                    AutenticacaoModel::Login( $email, $senha);
                    exit();
                }
            }

        } catch (Exception $e) {
            echo json_encode(['Erro ao efetuar login' => $e->getMessage()]);
        }
    }

    public static function Logoff(){
        AutenticacaoModel::Logoff();
        exit();
    }
}
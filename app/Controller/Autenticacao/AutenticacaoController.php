<?php

class AutenticacaoController
{
    private $googlePublicKey = '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'; // Insira sua chave pública aqui (ver abaixo como obter)


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

    public static function Cadastrar()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_POST['name'];
                $email = $_POST['email'];
                $senha = $_POST['password'];
                
                if($email && $senha && $nome) {
                    UsuarioModel::Cadastrar($nome, $email, $senha);
                    exit();
                }
            }
        } catch (Exception $e) {
            echo json_encode(['Erro ao efetuar cadastro' => $e->getMessage()]);
        }
    }


    public function googleLogin() {
        $token = $_POST['token'] ?? null;

        if (!$token) {
            echo json_encode(['success' => false, 'message' => 'Token não fornecido.']);
            return;
        }

        list($header, $payload, $signature) = explode('.', $token);

        $decodedHeader = json_decode(base64_decode($header), true);
        $decodedPayload = json_decode(base64_decode($payload), true);

        if (!$decodedHeader || !$decodedPayload) {
            echo json_encode(['success' => false, 'message' => 'Token inválido']);
            return;
        }

        if ($decodedPayload['aud'] !== '') {
            echo json_encode(['success' => false, 'message' => 'Token de audiência inválido']);
            return;
        }

        if (!$this->isValidSignature($header, $payload, $signature)) {
            echo json_encode(['success' => false, 'message' => 'Assinatura inválida']);
            return;
        }

        $email = $decodedPayload['email']; // E-mail do usuário

        if ($decodedPayload['email_verified']) AutenticacaoModel::LoginOAuth($email);

        echo json_encode(['success' => true, 'message' => 'Login bem-sucedido', 'user' => $decodedPayload]);
    }

    private function isValidSignature($header, $payload, $signature) {
        return true; 
    }

    public static function EsqueciMinhaSenha()
    {
        if(!isset($_SESSION['id'])) {

            try {
                $loader = new \Twig\Loader\FilesystemLoader('app/View/Autenticacao');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('EsqueciMinhaSenha.html');
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

    public static function RecuperarSenha()
    {
        if(!isset($_SESSION['id'])) {

            try {
                $loader = new \Twig\Loader\FilesystemLoader('app/View/Autenticacao');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('RecuperarSenha.html');
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

    public static function NovaSenha(string $token = null)
    {
        if (!isset($_SESSION['id'])) {
            try {
                $token = isset($_GET['param']) ? $_GET['param'] : $token;

                $loader = new \Twig\Loader\FilesystemLoader('app/View/Autenticacao');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('NovaSenha.html');
                
                if ($token) {
                    echo "Token recebido: " . $token;
                } else {
                    echo "Nenhum token foi fornecido.";
                }
                
                $conteudo = $template->render();
                echo $conteudo;
                
            } catch (Exception $e) {
                echo json_encode(['Erro' => $e->getMessage()]);
            }
        } else {
            header("Location: /");
        }
        exit();
    }
}
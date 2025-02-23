<?php

class UsuarioController
{
    public function Index()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Usuario');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('Index.html');

            $usuario = UsuarioModel::getUserById($_SESSION['id']);
            
            $parametros = array(
                'Usuario' => $usuario,
            );

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function Cadastrar()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Usuario');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('Cadastrar.html');

            $usuario = UsuarioModel::getUserById($_SESSION['id']);
            
            $parametros = array(
                'Usuario' => $usuario,
            );

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function alterarImagemDePerfil() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['base64']) && isset($_POST['id'])) {
                $base64 = $_POST['base64'];
        
                $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $base64);
                $base64 = base64_decode($base64);
        
                if ($base64) {
                    UsuarioModel::trocarFotoUsuario($_POST['id'], $base64);
                    echo json_encode(['success' => true, 'message' => 'Imagem alterada com sucesso.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao salvar a imagem.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Nenhuma imagem recebida.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Método não suportado.']);
        }
        exit();
    }

    public function removerImagemDePerfil() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UsuarioModel::removerFotoUsuario($_SESSION['id']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao remover imagem']);
        }
        exit();
    }
    
    public function trocarSenha() {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Usuario');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('TrocarSenha.html');

            $usuario = UsuarioModel::getUserById($_SESSION['id']);
            
            $parametros = array(
                'Usuario' => $usuario,
            );

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function trocarSenhaUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $senha = $_POST['senha'];
            $novaSenha = $_POST['novaSenha'];

            if ($senha && $novaSenha) {
                UsuarioModel::trocarSenhaUsuario($_SESSION['id'], $senha, $novaSenha);
            } else {
                echo json_encode(['success' => false, 'message' => 'Todos os campos são de preenchimento obrigatório']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao trocar senha']);
        }
        exit();
    }
}
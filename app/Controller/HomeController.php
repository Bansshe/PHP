<?php

class HomeController
{
    public function Index()
    {
        try {
            $usuario = UsuarioModel::getUserById($_SESSION['id']);
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('index.html');

            $parametros = array(
                '__' => 'arrayTraducao',
            );

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }
}
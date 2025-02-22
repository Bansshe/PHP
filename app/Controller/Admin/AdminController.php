<?php

class AdminController
{
    public function Index()
    {
        AdminController::Usuarios();
    }

    public function SQL()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Admin');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('sql.html');

            $parametros = array();

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function Parametros()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Admin');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('params.html');

            $parametros = array();

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function HistoricoOrcamentos()
    {
        $orcamentos = AdminModel::getAllOrcamentos();

        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Admin');
            $twig = new \Twig\Environment($loader);
            $aplicarIdioma = new Idioma('');
            $twig->addGlobal('_', $aplicarIdioma);
            $template = $twig->load('orcamento.html');

            $parametros = [
                'orcamentos' => $orcamentos,
            ];

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function Log()
    {
        $usuarios = UsuarioModel::getAllUsers();
        $logs = AdminModel::getAllLogs();

        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Admin');
            $twig = new \Twig\Environment($loader);
            $aplicarIdioma = new Idioma('');
            $twig->addGlobal('_', $aplicarIdioma);
            $template = $twig->load('mainlog.html');

            $parametros = [
                'usuarios' => $usuarios,
                'logs' => $logs,
            ];

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }

    public function GetLogById() {
        $usuarios = UsuarioModel::getAllUsers();
        $logs = AdminModel::getAllLogs();

        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Admin');
            $twig = new \Twig\Environment($loader);
            $aplicarIdioma = new Idioma('');
            $twig->addGlobal('_', $aplicarIdioma);
            $template = $twig->load('mainlog.html');

            $parametros = [
                'logs' => $logs,
            ];

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }

    }

    public function Usuarios()
    {
        $usuarios = UsuarioModel::getAllUsers();

        try {
            $loader = new \Twig\Loader\FilesystemLoader('app/View/Admin');
            $twig = new \Twig\Environment($loader);
            $aplicarIdioma = new Idioma('');
            $twig->addGlobal('_', $aplicarIdioma);
            $template = $twig->load('users.html');

            $parametros = [
                'usuarios' => $usuarios
            ];

            $conteudo = $template->render($parametros);

            echo $conteudo;

        } catch (Exception $e) {
            echo json_encode(['Erro ' => $e->getMessage()]);
        }
    }
}

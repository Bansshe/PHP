<?php

require_once __DIR__ . '/app/Core/Core.php';
require_once __DIR__ . '/app/Controller/Autenticacao/AutenticacaoController.php';
require_once __DIR__ . '/app/Controller/HomeController.php';
require_once __DIR__ . '/app/Controller/NotFoundController.php';
require_once __DIR__ . '/app/Controller/Admin/AdminController.php';
require_once __DIR__ . '/app/Model/UsuarioModel.php';
require_once __DIR__ . '/app/Model/Empresa/EmpresaModel.php';
require_once __DIR__ . '/lib/Database/Connection.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/Language/lang.php';
require_once __DIR__ . '/app/api/UsuarioAPI.php';
require_once __DIR__ . '/app/Controller/Usuario/UsuarioController.php';
require_once __DIR__ . '/app/Model/Autenticacao/AutenticacaoModel.php';
require_once __DIR__ . '/app/Model/Admin/AdminModel.php';

class Application {
    
    private $controller;
    private $action;

    public function run() {
        $path = $_SERVER['REQUEST_URI']; 
        $path = rtrim($path, '/'); 
        $path = filter_var($path, FILTER_SANITIZE_URL); 
        $path = explode('/', $path); 
        
        $this->controller = !empty($path[1]) ? ucfirst($path[1]) . 'Controller' : 'HomeController';
        $this->action = !empty($path[2]) ? $path[2] : 'Index';

        if (count($path) > 0 && $_GET) {
            if($path[1] == 'api' && $_GET['id']) {
                $api = $path[1] . '/' . $path[2] . '/' . $_GET['id'];
                if($api) {
                    return;
                }
            }
        }

        if(!isset($_SESSION['id'])){

            $this->controller = 'AutenticacaoController';

            $controllerInstance = new $this->controller();
            $this->action = !empty($path[2]) ? $path[2] : 'Index';
            
            if (!method_exists($controllerInstance, $this->action)) {
                $this->action = 'Index';
            }

            ob_start();

            call_user_func_array([$controllerInstance, $this->action], []);

            $template = ob_get_contents();

            ob_end_clean();

            echo $template;
            return;
        }

        if (!class_exists($this->controller)) {
            $this->controller = 'NotFoundController';
        }

        $controllerInstance = new $this->controller();

        if (!method_exists($controllerInstance, $this->action)) {
            $this->action = 'Index';
        }
        
        $dirShared = 'app/Template/Shared';
        $shared = file_get_contents($dirShared . '/shared.html');

        ob_start();
            call_user_func_array([$controllerInstance, $this->action], []);
            $conteudoDynamic = ob_get_contents();
        ob_end_clean();

        
        $loader = new \Twig\Loader\FilesystemLoader($dirShared);
        $twig = new \Twig\Environment($loader);
        $aplicarIdioma = new Idioma('');
        $twig->addGlobal('_', $aplicarIdioma);
        $shared = $twig->load('shared.html');   
        $config = include($_SERVER["DOCUMENT_ROOT"] . "/config.php");

        $parametros = [
            'data' => [
                'Versao' => $config['Versao'],
                'Servidor' => $config['Servidor'],
            ],
            'Usuario' => UsuarioModel::getUserById($_SESSION['id']),
            'Empresa' => EmpresaModel::getEmpresaById($_SESSION['id']),
            'DynamicContent' => '{{DynamicContent}}',
        ];
        
        $conteudoShared = $shared->render(context: $parametros);
        
        $template = str_replace('{{DynamicContent}}', $conteudoDynamic, $conteudoShared);

        echo $template;
    }
}

$app = new Application();
$app->run();

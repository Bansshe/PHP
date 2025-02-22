<?php

class UsuarioAPI
{
    public function getUsuarioProfilePicture() {
        $getId = isset($_GET['id']) ? $_GET['id'] : null;
        $token = isset($_GET['token']) ? $_GET['token'] : null;

        if ($token === "BOIB23PNR23YIO5BN23JHB5312PIB423UN") {
            if ($getId !== null && is_numeric($getId)) {
                $fotoUsuario = UsuarioModel::getFotoUsuarioById($getId);
                if ($fotoUsuario) {
                     echo $fotoUsuario;
                } else {
                    http_response_code(404);
                }
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    }
}

if($_GET ) {
    
    $app = new UsuarioAPI();

    switch($_GET['action']){
        case 'getUsuarioProfilePicture':
            $app->getUsuarioProfilePicture();
            break;
        default:
            break;
    }

} elseif ($_POST) {
    return;
} else {
    return;
}

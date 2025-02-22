<?php
class Idioma {

    public function Idioma($str) {

        $idiomaEmpresa = EmpresaModel::getEmpresaById(1)->Idioma ?? null;

        if ($idiomaEmpresa != null) {
            $language = $idiomaEmpresa;
        } else if ($_SERVER['HTTP_ACCEPT_LANGUAGE']) {
            $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        } else {
            $language = 'en';
        }
        
    switch (true) {
        case str_contains($language, 'pt-BR'):
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/ptBR.php");
            break;
        case str_contains($language, 'es'):
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/esAR.php");
            break;
        case str_starts_with($language, 'pt'):
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/ptPT.php");
            break;
        case str_contains($language, 'de'):
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/deDE.php");
            break;
        case str_contains($language, 'fr'):
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/frFR.php");
            break;
        case str_contains($language, 'it'):
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/itIT.php");
            break;
        default:
            $this->lang = include($_SERVER["DOCUMENT_ROOT"] . "/lib/Language/enUS.php");
            break;
    }
    
    return $this->lang[$str] ?? $str;
}

}
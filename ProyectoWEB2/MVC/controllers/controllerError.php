<?php
// Se requieren los archivos y clases necesarios
require_once "./MVC/Views/viuError.php";
require_once './MVC/Helpers/LoginHelper.php';

// Declaración de la clase ControllerError
class ControllerError{
    // Definición de propiedades de la clase
    private $viuError;
    private $authHelper;

    // Constructor de la clase
    public function __construct(){
        // Inicialización de objetos y propiedades
        $this->viuError = new viuError();
        $this->authHelper = new AuthHelper();
    }

    // Método para mostrar un aviso de error
    public function pasarShowError($aviso){
        $this->authHelper->init();
        // Llama al método showAviso de la clase ViuError para mostrar el aviso
        $this->viuError->showAviso($aviso);
    }
}
?>
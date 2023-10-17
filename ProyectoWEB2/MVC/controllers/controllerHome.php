<?php
// Se requieren los archivos y clases necesarios
require_once './MVC/Views/ViuHome.php';
require_once './MVC/Models/ModelUsuario.php';
require_once './MVC/Helpers/LoginHelper.php';
require_once './MVC/Models/ModelActualizaciones.php';
require_once './MVC/controllers/controllerError.php';

// Declaración de la clase ControllerHome
class ControllerHome {
    // Definición de propiedades de la clase
    private $viuHome;
    private $modelUsuarios;
    private $authHelper;
    private $modelActualizaciones;
    private $controllerError;

    // Constructor de la clase
    public function __construct(){
        // Inicialización de objetos y propiedades
        $this->viuHome = new ViuHome();
        $this->modelUsuarios = new ModelUsuario();
        $this->authHelper = new AuthHelper();
        $this->modelActualizaciones = new ModelActualizaciones();
        $this->controllerError = new ControllerError();
    }

    // Método para mostrar la página de inicio
    public function showHome(){
        $this->authHelper->init();
        // Obtiene las actualizaciones y muestra la página de inicio
        $Actualizaciones = $this->modelActualizaciones->showActualizaciones();
        $this->viuHome->showHome($Actualizaciones);
    }

    // Método para agregar una actualización
    public function addActualizacion(){
        // Obtiene los datos del formulario
        $nuevo = $_POST['Nuevo'];
        $fecha = $_POST['Fecha'];
        if(!empty($nuevo) && !empty($fecha)){
            // Intenta agregar la actualización a la base de datos
            $resultado = $this->modelActualizaciones->addActualizacion($fecha,$nuevo);
            if($resultado){
                header('Location: ' . BASE_URL);
            }else{
                // En caso de error, muestra un mensaje de error
                $this->controllerError->pasarShowError("Error al ingresar en la base de datos");
            }
        }else{
            // Muestra un mensaje de error si faltan datos
            $this->controllerError->pasarShowError("Ingrese todos los datos, se encontraron espacios vacíos");
        }
    }

    // Método para eliminar una actualización
    public function deleteActualizacion($id){
        // Elimina la actualización con el ID especificado
        $this->modelActualizaciones->deleteActualizacion($id);

        $resultado = $this->modelActualizaciones->deleteActualizacion($id);
        if($resultado){
            header('Location: ' . BASE_URL);
        }else{
            // En caso de error, muestra un mensaje de error
            $this->controllerError->pasarShowError("Error al borrar Actualización");
        }
    }

    // Método para mostrar la conversión de criptomonedas
    public function showConveccion(){
        $this->authHelper->init();
        if(isset($_POST['convertir']) || isset($_POST['conveccion']) ){
            $convertir = $_POST['convertir'];
            $conveccion = $_POST['conveccion'];
        
            $url = "https://criptoya.com/api/binance/".$convertir."/".$conveccion."/1";
            $json = file_get_contents($url);
            $datos = json_decode($json,true);
         
            $precio = $datos['ask'];
           
            $Actualizaciones = $this->modelActualizaciones->showActualizaciones();
            $this->viuHome->showConveccion($precio,$Actualizaciones);
        }else{
            // En caso de error, muestra un mensaje de error
            $this->controllerError->pasarShowError("Error al hacer la conversión, vuelva a intentarlo más tarde.");
        }
    }
}
?>
<?php
// Se requieren los archivos y clases necesarios
require_once './MVC/Views/ViuBilletera.php';
require_once './MVC/Models/ModelUsuario.php';
require_once './MVC/Models/ModelInversiones.php';
require_once './MVC/Helpers/LoginHelper.php';
require_once './MVC/Models/ModelBilletera.php';
require_once './MVC/Models/ModelPlanes.php';
require_once './MVC/controllers/controllerError.php';

// Declaración de la clase ControllerBilletera
class ControllerBilletera {
    // Definición de propiedades de la clase
    private $viuBilletera;
    private $modelInversiones;
    private $authHelper;
    private $modelBilletera;
    private $modelUsuario;
    private $modelPlanes;
    private $controllerError;

    // Constructor de la clase
    public function __construct(){
        // Inicialización de objetos y propiedades
        $this->viuBilletera = new ViuBilletera();
        $this->modelInversiones = new ModelInversiones();
        $this->authHelper = new AuthHelper();
        $this->modelBilletera = new ModelBilletera();
        $this->modelUsuario = new ModelUsuario();
        $this->modelPlanes = new ModelPlanes();
        $this->controllerError = new ControllerError();
    }

    // Método para mostrar la billetera
    public function showBilletera(){
        $this->authHelper->init();

        if(!isset($_SESSION['Id'])){
            $id = 0;
        }else{
            $id = $_SESSION['Id'];
        }

        if($id == 0){
            $datosTotales = $this->modelInversiones->getInversiones();
            $this->viuBilletera->showBilleteraSinLoguearse($datosTotales);
        }else{
            $datosUsuario = $this->modelUsuario->getUsuario($id);
            $datosPlan = $this->modelPlanes->getPlanes();
            $datos = $this->modelInversiones->getInversion($id);
            $datosTotales = $this->modelInversiones->getInversiones();
            $this->viuBilletera->showBilleteraDatos($datos, $datosTotales, $datosUsuario, $datosPlan);
        }
    }

    // Método para comprar un plan de inversión
    public function comprarPlan(){
        $this->authHelper->init();
        $idPlan = $_POST['IDPlan'];
        $idUsuario = $_SESSION['Id'];
        $fechaActual = date('Y-m-d');

        if($this->modelInversiones->comprarPlan($idPlan, $idUsuario, $fechaActual)){
            header('Location: ' . BASE_URL);
        }else{
            $this->controllerError->pasarShowError("Error al Comprar plan");
        }
    }

    // Método para eliminar una inversión
    public function deleteInversion($id){
        $this->modelInversiones->deleteInversion($id);

        if($this->modelInversiones->deleteInversion($id)){
            header('location: ' . BASE_URL);
        }else{
            $this->controllerError->pasarShowError("Error al Eliminar Inversión, vuelva a intentarlo");
        }
    }

    // Método para mostrar la edición de una inversión
    public function showEditInversion($id){
        $this->authHelper->init();
        if(!empty($_SESSION['Id'])){
            $datos = $this->modelBilletera->getInversion($id);
            $datosPlanes = $this->modelPlanes->getPlanes();
            $this->viuBilletera->mostrarEditInversion($datos, $datosPlanes);
        }else{
            $this->controllerError->pasarShowError("Error al Editar Inversión, vuelva a intentarlo");
        }
    }

    // Método para volver a editar una inversión
    public function reEdit(){
        $idInversion = $_POST['IDInversiones'];
        $IDPlan = $_POST['planSeleccionado'];

        $id = $this->modelBilletera->editInversion($idInversion, $IDPlan);

        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->controllerError->pasarShowError("Error al editar Inversión");
        }
    }
}
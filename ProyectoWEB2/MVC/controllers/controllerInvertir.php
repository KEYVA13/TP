<?php
// Se requieren los archivos y clases necesarios
require_once './MVC/Views/ViuInvertir.php';
require_once './MVC/Models/ModelUsuario.php';
require_once './MVC/Models/ModelPlanes.php';
require_once './MVC/controllers/controllerError.php';

// Declaración de la clase ControllerInvertir
class ControllerInvertir {
    // Definición de propiedades de la clase
    private $viuInvertir;
    private $modelUsuarios;
    private $modelPlanes;
    private $authHelper;
    private $controllerError;

    // Constructor de la clase
    public function __construct(){
        // Inicialización de objetos y propiedades
        $this->viuInvertir = new ViuInvertir();
        $this->modelUsuarios = new ModelUsuario();
        $this->modelPlanes = new ModelPlanes();
        $this->authHelper = new AuthHelper();
        $this->controllerError = new ControllerError();
    }

    // Método para mostrar la página de inversión
    public function showInvertir(){
        $this->authHelper->init();
        $this->viuInvertir->showInvertir();
    }

    // Método para agregar un plan de inversión
    public function addPlan(){
        if(empty($_POST['plan']) || empty($_POST['duracion']) || empty($_POST['precio']) || empty($_POST['porcentaje'])){
            $this->controllerError->pasarShowError("Error, faltan rellenar campos.");
            return;
        }else{
        if(isset($_POST['plan']) && isset($_POST['duracion']) && isset($_POST['precio']) && isset($_POST['porcentaje'])){
            $plan = $_POST['plan'];
            $duracion = $_POST['duracion'];
            $precio = $_POST['precio'];
            $porcentaje = $_POST['porcentaje'];

            $id = $this->modelPlanes->addPlan($plan,$duracion,$precio,$porcentaje);

            if ($id) {
             header('Location: ' . BASE_URL);
             } else {
                $this->controllerError->pasarShowError("Error al agregar plan, vuelva a intentarlo.");
            }
        }else{
            $this->controllerError->pasarShowError("Error, vuelva a intentarlo.");
        }
      }
    }

    // Método para mostrar los planes de inversión
    public function showPlanes(){
        $this->authHelper->init();
        $planes = $this->modelPlanes->getPlanes();
        $this->viuInvertir->showPlanes($planes);
    }

    // Método para eliminar un plan de inversión
    public function deletePlan($id){
        if($this->modelPlanes->deletePlan($id)){
            header('location: ' . BASE_URL);
        }else{
            $this->controllerError->pasarShowError("Error al borrar plan.");
        }
    }

    // Método para mostrar la página de edición de un plan de inversión
    public function showEditPlan($id){
        $this->authHelper->init();
        $datosUsuario = $this->modelPlanes->getPlan($id);
        $this->viuInvertir->showEdit($datosUsuario);
    }

    // Método para editar un plan de inversión
    public function editPlan(){
        if(empty($_POST['IDPlan']) || empty($_POST['Plan']) || empty($_POST['Duracion']) || empty($_POST['Precio']) || empty($_POST['Porcentaje'])){
            $this->controllerError->pasarShowError("Error, faltan cargar datos, vuelva a intentarlo con todos los datos.");
            return;
        }else{
        if(isset($_POST['IDPlan']) && isset($_POST['Plan']) && isset($_POST['Duracion']) && isset($_POST['Precio']) && isset($_POST['Porcentaje'])){
            $plan = $_POST['Plan'];
            $duracion = $_POST['Duracion'];
            $precio = $_POST['Precio'];
            $porcentaje = $_POST['Porcentaje'];
            $idUser = $_POST['IDPlan'];

            $id = $this->modelPlanes->editPlan($idUser,$plan,$duracion,$precio,$porcentaje);

            if ($id) {
             header('Location: ' . BASE_URL);
             } else {
                $this->controllerError->pasarShowError("Error, vuelva a intentarlo.");
            }
        }else{
            header('Location: ' . BASE_URL);
        }
      }
    }

    // Método para mostrar la página de compra de un plan de inversión
    public function showBuyPlan($id){
        $this->authHelper->init();
        $plan = $this->modelPlanes->getPlan($id);
        $this->viuInvertir->showBuyPlan($plan);
    }
}
?>
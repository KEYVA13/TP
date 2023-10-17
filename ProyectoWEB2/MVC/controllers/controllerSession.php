<?php
// Se requieren los archivos y clases necesarios
require_once './MVC/Views/ViuLogin.php';
require_once './MVC/Models/ModelUsuario.php';
require_once './MVC/helpers/LoginHelper.php';
require_once './MVC/controllers/controllerError.php';

// Declaración de la clase ControllerSession
class ControllerSession {
    // Definición de propiedades de la clase
    private $viuLogin;
    private $modelUsuarios;
    private $controllerError;

    // Constructor de la clase
    public function __construct(){
        // Inicialización de objetos y propiedades
        $this->viuLogin = new ViuLogin();
        $this->modelUsuarios = new ModelUsuario();
        $this->controllerError = new ControllerError();
    }

    // Método para mostrar la página de inicio de sesión
    public function showLogin(){
        $this->viuLogin->showLogin();
    }

    // Método para realizar el inicio de sesión
    public function loguearse(){
        // Obtener datos del formulario de inicio de sesión
        $user = $_POST['nombre'];
        $password = $_POST['contraseña'];

        if (!(empty($user) && empty($password))) {
            // Buscar el usuario en la base de datos
            $datos = $this->modelUsuarios->buscarUsuario($user);
            if (!empty($datos) && password_verify($password, $datos->Password)) {
                // Iniciar sesión si el usuario y la contraseña son correctos
                AuthHelper::login($datos);
                header('Location: ' . BASE_URL);
            } else {
                $this->controllerError->pasarShowError("Contraseña o usuario incorrectos.");
                // Usuario o contraseña incorrectos
            }
        } else {
            $this->controllerError->pasarShowError("Faltan completar datos.");
            // Completar todos los datos
        }
    }

    // Método para cerrar la sesión
    public function cerrarSesion(){
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}
?>

<?php
// Definición de la clase AuthHelper
class AuthHelper {

    // Método para inicializar la sesión si no está activa
    public static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    // Método para realizar el inicio de sesión
    public static function login($datos){
        AuthHelper::init();
        // Almacenar información del usuario en la sesión
        $_SESSION['Id'] = $datos->IDUsuario;
        $_SESSION['User'] = $datos->UserName;
        $_SESSION['Password'] = $datos->Password;
    }

    // Método para cerrar la sesión
    public static function logout(){
        AuthHelper::init();
        // Destruir la sesión, lo que cierra la sesión del usuario
        session_destroy();
    }

    // Método para verificar si el usuario está autenticado
    public static function verify(){
        AuthHelper::init();
        if(!isset($_SESSION['Id'])){
            // Redirigir a la página de inicio de sesión si el usuario no está autenticado
            header('Location: ' . BASE_URL . '/login');
            die();
        }
    }
}
?>

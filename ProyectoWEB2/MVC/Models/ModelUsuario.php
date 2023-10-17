<?php
require_once './MVC/Models/ModelDB.php';

class ModelUsuario extends ModelDB {

    // Obtiene la lista de todos los usuarios
    public function getUsuarios() {
        $datos = $this->conexion->prepare('SELECT * FROM usuarios');
        $datos->execute();
        $usuarios = $datos->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    // Busca un usuario por su nombre de usuario (UserName)
    public function buscarUsuario($UserName) {
        $datos = $this->conexion->prepare('SELECT * FROM usuarios WHERE UserName = ?');
        $datos->execute([$UserName]);

        // Devuelve un objeto con los datos del usuario si se encuentra, de lo contrario, devuelve NULL
        return $datos->fetch(PDO::FETCH_OBJ);
    }

    // Obtiene información de un usuario según su ID
    public function getUsuario($id) {
        $datos = $this->conexion->prepare('SELECT * FROM usuarios WHERE IDUsuario = ?');
        $datos->execute([$id]);

        // Devuelve un objeto con los datos del usuario si se encuentra, de lo contrario, devuelve NULL
        return $datos->fetch(PDO::FETCH_OBJ);
    }
}
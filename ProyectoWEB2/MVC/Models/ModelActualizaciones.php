<?php
require_once './MVC/Models/ModelDB.php';

class ModelActualizaciones extends ModelDB {

    // Obtiene todas las actualizaciones almacenadas en la base de datos
    public function showActualizaciones() {
        $datos = $this->conexion->prepare('SELECT * FROM actualizaciones');
        $datos->execute();

        $actualizaciones = $datos->fetchAll(PDO::FETCH_OBJ);

        return $actualizaciones;
    }

    // Agrega una nueva actualización a la base de datos con una fecha y contenido específicos
    public function addActualizacion($fecha, $nuevo) {
        $datos = $this->conexion->prepare('INSERT INTO actualizaciones (Fecha, Nuevo) values(?, ?)');
        $datos->execute([$fecha, $nuevo]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    // Elimina una actualización de la base de datos según su ID
    public function deleteActualizacion($id) {
        $datos = $this->conexion->prepare('DELETE FROM actualizaciones WHERE IDActualizaciones = ?');
        $datos->execute([$id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }
}
?>
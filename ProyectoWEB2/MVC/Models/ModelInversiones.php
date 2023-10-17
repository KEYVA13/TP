<?php
require_once './MVC/Models/ModelDB.php';

class ModelInversiones extends ModelDB {
    
    // Obtiene información de una inversión específica según el ID de usuario
    public function getInversion($id) {
        $datos = $this->conexion->prepare("SELECT * FROM inversiones 
                                           INNER JOIN planes ON inversiones.IDPlan = planes.ID 
                                           INNER JOIN usuarios ON inversiones.IDUsuario = usuarios.IDUsuario 
                                           WHERE inversiones.IDUsuario = ?");
        $datos->execute([$id]);
        $inversion = $datos->fetch(PDO::FETCH_OBJ);
        return $inversion;
    }

    // Obtiene todas las inversiones realizadas por usuarios
    public function getInversiones() {
        $datos = $this->conexion->prepare('SELECT * FROM inversiones 
                                           INNER JOIN planes ON inversiones.IDPlan = planes.ID 
                                           INNER JOIN usuarios ON inversiones.IDUsuario = usuarios.IDUsuario');
        $datos->execute();
        $inversiones = $datos->fetchAll(PDO::FETCH_OBJ);
        return $inversiones;
    }

    // Realiza la compra de un plan para un usuario
    public function comprarPlan($idPlan, $idUsuario, $fechaActual) {
        $datos = $this->conexion->prepare('INSERT INTO inversiones (IDUsuario, IDPlan, Fecha) VALUES (?, ?, ?)');
        $datos->execute([$idUsuario, $idPlan, $fechaActual]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    // Elimina una inversión según su ID
    public function deleteInversion($id) {
        $datos = $this->conexion->prepare('DELETE FROM inversiones WHERE IDInversiones = ?');
        $datos->execute([$id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }
}

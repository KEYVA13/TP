<?php
require_once './MVC/Models/ModelDB.php';

class ModelBilletera extends ModelDB {
    
    // Obtiene información de una inversión específica según su ID
    public function getInversion($id) {
        $datos = $this->conexion->prepare("SELECT * FROM inversiones 
                                           INNER JOIN planes ON inversiones.IDPlan = planes.ID 
                                           INNER JOIN usuarios ON inversiones.IDUsuario = usuarios.IDUsuario 
                                           WHERE inversiones.IDInversiones = ?");
        $datos->execute([$id]);
        $inversion = $datos->fetch(PDO::FETCH_OBJ);
        return $inversion;
    }

    // Edita una inversión existente, actualizando el plan asociado
    public function editInversion($idInversion, $IDPlan) {
        $datos = $this->conexion->prepare('UPDATE inversiones SET IDPlan = ? WHERE IDInversiones = ?');
        $datos->execute([$IDPlan, $idInversion]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }
}
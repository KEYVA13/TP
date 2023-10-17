<?php
require_once './MVC/Models/ModelDB.php';

class ModelPlanes extends ModelDB {
    
    // Agrega un nuevo plan a la base de datos
    public function addPlan($plan, $duracion, $precio, $porcentaje) {
        $datos = $this->conexion->prepare('INSERT INTO planes (Plan, Duracion, Precio, Porcentaje) VALUES (?, ?, ?, ?)');
        $datos->execute([$plan, $duracion, $precio, $porcentaje]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    // Obtiene la lista de todos los planes disponibles
    public function getPlanes() {
        $datos = $this->conexion->prepare('SELECT * FROM planes');
        $datos->execute();
        $planes = $datos->fetchAll(PDO::FETCH_OBJ);
        return $planes;
    }

    // Elimina un plan según su ID
    public function deletePlan($id) {
        $datos = $this->conexion->prepare('DELETE FROM planes WHERE ID = ?');
        $datos->execute([$id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    // Obtiene información de un plan según su ID
    public function getPlan($id) {
        $datos = $this->conexion->prepare('SELECT * FROM planes WHERE ID = ?');
        $datos->execute([$id]);
        $plan = $datos->fetch(PDO::FETCH_OBJ);
        return $plan;
    }

    // Edita un plan según su ID con nuevos valores
    public function editPlan($id, $plan, $duracion, $precio, $porcentaje) {
        $datos = $this->conexion->prepare('UPDATE planes SET Plan = ?, Duracion = ?, Precio = ?, Porcentaje = ? WHERE ID = ?');
        $datos->execute([$plan, $duracion, $precio, $porcentaje, $id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }
}
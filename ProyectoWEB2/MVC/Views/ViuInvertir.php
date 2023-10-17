<?php

class ViuInvertir {
    // Muestra la página de inversión
    public function showInvertir() {
        require 'templates/invertir.phtml';
    }

    // Muestra la página de inversión con la lista de planes
    public function showPlanes($planes) {
        require_once 'templates/invertir.phtml';
    }

    // Muestra la página de edición de planes
    public function showEdit($datosUsuario) {
        require_once 'templates/edit.phtml';
    }

    // Muestra la información de un plan específico
    public function showMostrar($id, $plan) {
        require_once 'templates/pruebas.phtml';
    }

    // Muestra la página de compra de un plan
    public function showBuyPlan($Plan) {
        require_once 'templates/infoPlan.phtml';
    }
}
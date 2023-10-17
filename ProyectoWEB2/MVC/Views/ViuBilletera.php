<?php

class ViuBilletera {
    // Muestra la billetera con datos de usuario y planes
    public function showBilleteraDatos($datos, $datosTotales, $datosUsuario, $datosPlanes) {
        require 'templates/billetera.phtml';
    }

    // Muestra la billetera sin estar logueado
    public function showBilleteraSinLoguearse($datosTotales) {
        require 'templates/billetera.phtml';
    }

    // Muestra la edición de una inversión
    public function mostrarEditInversion($datos, $datosPlanes) {
        require 'templates/editInversion.phtml';
    }
}
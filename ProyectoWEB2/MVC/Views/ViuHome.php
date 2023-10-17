<?php

class ViuHome {
    // Muestra la página de inicio con las actualizaciones y un aviso opcional
    public function showHome($Actualizaciones, $aviso = null) {
        require 'templates/home.phtml';
    }

    // Muestra la conversión de precios y las actualizaciones
    public function showConveccion($precio, $Actualizaciones) {
        require 'templates/home.phtml';
    }
}
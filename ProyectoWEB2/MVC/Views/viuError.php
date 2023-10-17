<?php

class viuError {
    // Muestra un mensaje de aviso o error
    public function showAviso($aviso) {
        require 'templates/errores.phtml';
    }
}
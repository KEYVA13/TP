<?php
require_once "config.php";

class ModelDB {
    protected $conexion;

    function __construct() {
        $this->conexion = new PDO('mysql:host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASSWORD);
        $this->deploy();
    }

    function deploy() {
        // Chequear si la base de datos "tpweb" existe
        $query = $this->conexion->query('SHOW DATABASES LIKE "tpweb"');
        $databaseExists = $query->rowCount() > 0;

        if (!$databaseExists) {
            // Si la base de datos no existe, créala
            $this->conexion->exec('CREATE DATABASE tpweb');
        }

        // Seleccionar la base de datos "tpweb"
        $this->conexion->exec('USE tpweb');

        // Creación de la tabla "usuarios" (sin restricciones de clave externa)
        $this->conexion->exec('
            CREATE TABLE IF NOT EXISTS `usuarios` (
                `IDUsuario` int(11) NOT NULL AUTO_INCREMENT,
                `UserName` varchar(50) NOT NULL,
                `Password` varchar(255) NOT NULL,
                PRIMARY KEY (`IDUsuario`)
            )
        ');

        // Insertar datos en la tabla "usuarios" solo si no existen registros
        $query = $this->conexion->query('SELECT * FROM `usuarios`');
        if ($query->rowCount() == 0) {
            $password = 'admin'; // Cambia esto por la contraseña deseada
            $passwordEncriptada = password_hash($password, PASSWORD_DEFAULT);
            $this->conexion->exec('
                INSERT INTO `usuarios` (`UserName`, `Password`) VALUES
                ("webadmin", "' . $passwordEncriptada . '")
            ');
        }

        // Creación de la tabla "planes" (sin restricciones de clave externa)
        $this->conexion->exec('
            CREATE TABLE IF NOT EXISTS `planes` (
                `ID` int(10) NOT NULL AUTO_INCREMENT,
                `Plan` varchar(50) NOT NULL,
                `Duracion` int(10) NOT NULL,
                `Precio` int(10) NOT NULL,
                `Porcentaje` int(10) NOT NULL,
                PRIMARY KEY (`ID`)
            )
        ');

        // Insertar datos en la tabla "planes" solo si no existen registros
        $query = $this->conexion->query('SELECT * FROM `planes`');
        if ($query->rowCount() == 0) {
            $this->conexion->exec('
                INSERT INTO `planes` (`Plan`, `Duracion`, `Precio`, `Porcentaje`) VALUES
                ("PLAN A", 10, 20, 10),
                ("PLAN B", 210, 1000, 90),
                ("PLAN C", 360, 10000, 100),
                ("PLAN D", 150, 100000, 200)
            ');
        }

        // Creación de la tabla "actualizaciones" (sin restricciones de clave externa)
        $this->conexion->exec('
            CREATE TABLE IF NOT EXISTS `actualizaciones` (
                `IDActualizaciones` int(10) NOT NULL AUTO_INCREMENT,
                `Fecha` date NOT NULL,
                `Nuevo` varchar(50) NOT NULL,
                PRIMARY KEY (`IDActualizaciones`)
            )
        ');

        // Insertar datos en la tabla "actualizaciones" solo si no existen registros
        $query = $this->conexion->query('SELECT * FROM `actualizaciones`');
        if ($query->rowCount() == 0) {
            $this->conexion->exec('
                INSERT INTO `actualizaciones` (`Fecha`, `Nuevo`) VALUES
                ("2024-03-13", "PLAN Z"),
                ("2024-08-13", "PLAN X"),
                ("2025-01-01", "PLAN W")
            ');
        }

        // Creación de la tabla "inversiones" (con restricciones de clave externa)
        $this->conexion->exec('
            CREATE TABLE IF NOT EXISTS `inversiones` (
                `IDInversiones` int(10) NOT NULL AUTO_INCREMENT,
                `IDUsuario` int(10) NOT NULL,
                `IDPlan` int(10) NOT NULL,
                `Fecha` date NOT NULL,
                PRIMARY KEY (`IDInversiones`),
                KEY `IDUsuario` (`IDUsuario`),
                KEY `IDPlan` (`IDPlan`),
                CONSTRAINT `inversiones_ibfk_1` FOREIGN KEY (`IDPlan`) REFERENCES `planes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `inversiones_ibfk_2` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`IDUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
            )
        ');

        // Insertar datos en la tabla "inversiones" solo si no existen registros
        $query = $this->conexion->query('SELECT * FROM `inversiones`');
        if ($query->rowCount() == 0) {
            $this->conexion->exec('
                INSERT INTO `inversiones` (`IDUsuario`, `IDPlan`, `Fecha`) VALUES
                (1, 1, "2023-10-16"),
                (1, 2, "2023-03-13"),
                (1, 3, "2022-12-20"),
                (1, 4, "2023-06-24")
            ');
        }
    }
}
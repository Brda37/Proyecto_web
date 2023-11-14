<?php
     $servidor = "localhost";
     $baseDatos = "proyecto_web";
     $usuario = "root";
     $contrasena = "";

     try{
          $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos;",$usuario,$contrasena);
     }
     catch(Exception $ex){
          echo $ex->getMessage();
     }
?>
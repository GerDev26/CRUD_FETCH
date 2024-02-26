<?php
    require "clientes.php";
    // Crear un objeto de la clase Clientes
    $clientes = new Clientes();
    
    // Usar el método para mostrar los datos de los clientes
    $datos = $clientes->getAll();
    echo json_encode($datos);
?>
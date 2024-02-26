<?php
    require "clientes.php";
    // Crear un objeto de la clase Clientes
    $clientes = new Clientes();

    $requestData = file_get_contents('php://input');

    // Decodificar los datos JSON en un array asociativo
    $requestDataArray = json_decode($requestData, true);

    $result = $clientes->getId($requestDataArray);

    echo json_encode($result);
?>
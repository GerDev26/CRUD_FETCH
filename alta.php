<?php
    require "clientes.php";
    $clientes = new Clientes();
    
    $requestData = file_get_contents('php://input');

    $requestDataArray = json_decode($requestData, true);

    $clientes->insert($requestDataArray);

?>
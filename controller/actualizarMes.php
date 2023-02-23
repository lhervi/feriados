<?php
include_once (__DIR__ ."/../contantes.php");
include_once (__DIR__ . "/classFeriado.php");


if (isset($_POST['fecha'])){

    $diasTexto = explode(", ", $_POST['dias']);

    $fecha = $_POST['fecha'];

    $añoTexto = substr($fecha, 0, 4);
    $mesTexto = substr($fecha, 5);
    
    $objFeriado = new Feriado();

    $resultado = $objFeriado->setMonth($añoTexto, $mesTexto, $diasTexto);
    
    echo json_encode($resultado);

}else{
    echo json_encode("no se procesaron los datos");
}



?>

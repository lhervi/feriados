<?php

include_once "./classFecha.php";

$ahora=getdate();

$dias = Fecha::getListaDias();
$meses = Fecha::getListaMeses(false, false);

$file = file_get_contents(__DIR__ . "/jsonFiles/feriados.json");
$fileArray = json_decode($file, true);


if(isset($_GET['año'])){

    if ($_GET['año']=='all' || $_GET['año']=='todos'){
        echo json_encode($fileArray);
        exit;
    }

    $año = intval($_GET['año']);    
    if (!Fecha::yearOk($año)){
        $respuesta = ["error"=>strval($año) ." no es un año válido"];
        $respuestaJson = json_encode($respuesta, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
        echo $respuestaJson;
        exit;    
    }
}else{
    $año = $ahora['year'];    
}

if(isset($_GET['mes'])){    
    $mes = intval($_GET['mes']);  
}

if(isset($_GET['dia'])){
    $mes = intval($_GET['mes']);  
}




$respuesta = null;

if (isset($fileArray[$año])){
    $respuesta = [strval($año)=>$fileArray[$año]];
    if(isset($mes)) {       

        if  (Fecha::monthOk($mes)){
            $respuesta = [strval($año)=>[$meses[$mes]=>$fileArray[$año][$meses[$mes-1]]]];            
        }else{
            $respuesta = ["error"=>"el mes debe ser mayor o igual a 1 y menor o igual a 12"];
        }
    }
}
$respuestaFinal = json_encode($respuesta, JSON_UNESCAPED_UNICODE, JSON_PRETTY_PRINT);
echo $respuestaFinal;
$a=5;
?>
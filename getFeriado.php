<?php

$ahora=getdate();

$meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
$dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
$mes =13;



if(isset($_GET['año'])){
    $año = intval($_GET['año']);    
}else{
    $año = $ahora['year'];    
}

if(isset($_GET['mes'])){    
    $mes = intval($_GET['mes']);  
}

if(isset($_GET['dia'])){
    $mes = intval($_GET['mes']);  
}


$file = file_get_contents("feriados.json");
$fileArray = json_decode($file, true);

$respuesta = null;

if (isset($fileArray[$año])){
    $respuesta = $fileArray[$año];
    if(isset($fileArray[$año][$meses[$mes-1]])){
        $respuesta = $fileArray[$año][$meses[$mes-1]];
    }
}

echo json_encode($respuesta);
?>
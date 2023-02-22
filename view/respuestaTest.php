<?php

$respuesta  = $_POST['mensaje'];

echo json_encode("el mensaje es: " . $respuesta);

?>
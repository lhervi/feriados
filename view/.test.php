<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
       
    <div class = "container">

    <br>
    <div><h1>Test Fetch</h1></div>
    <br>
    <input type = "text" name = "mensaje" id = "id_mensaje">
    <input type = "button" name = "enviar" id = "btn_enviar" value="enviar">

    </div>
    
        
        <script>

        function fn_enviar(){
            
            const url = 'http://10.150.11.96:9012/view/respuestaTest.php';
            fecha ="2023-02-22";
            
            var forma = new FormData();
            forma.append("mensaje", mensaje.value);
            forma.append("fecha", fecha);

            var requestOptions = {
            method: 'POST',
            body: forma,
            redirect: 'follow'
            };

            fetch(url, requestOptions)
            .then(response => response.text())
            .then(result => console.log(result))
            .catch(error => console.log('error', error));
        }

        function fn_enviar2(){
            
            const url = 'http://10.150.11.96:9012/view/respuestaTest.php';
            fecha ="2023-02-22";

            var forma = new FormData();
            //forma.append("mensaje", mensaje.value);
            forma.append("mensaje", "primer mensaje");
            //
            forma.append("fecha", "2023-02-22");

            const data = {
                mensaje: mensaje.value,
                fecha: fecha
            }

            const options = {
                method: 'POST',
                body: JSON.stringify(data),
                redirect: 'follow'
            }
            
            fetch(url, options)
            .then(resultado => respuesta.json())
            .then(json => console.log(json));

        }

        function fn_enviar3(){
            
            const url = 'http://10.150.11.96:9012/view/respuestaTest.php';
            fecha ="2023-02-22";
            
            const data = {
                mensaje: mensaje.value,
                fecha: fecha
            }

            dataJSON = JSON.stringify(data);

            const options = {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: dataJSON                                
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', url);
            xhr.send(dataJSON);
            
/*             fetch(url, options)
            .then(resultado => respuesta.json())
            .then(json => console.log(json)); */

        }

        mensaje = document.getElementById("id_mensaje");
        enviar = document.getElementById("btn_enviar");

        enviar.addEventListener('click', fn_enviar3);

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
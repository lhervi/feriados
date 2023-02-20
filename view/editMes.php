<?php

include_once("./encabezado.php");

?>

<div class="container">
<br><br>
<div><h1>Edición de dias</h1></div>
<br>
<table class="table">
    <thead>
        <th><h2>Año 2022</h2></th>
    </thead>
    <tbody>
        <tr class="mes">
            <th>Mes:</th>
            <th>Abril</th>
        </tr>
        <tr class="mes">
            <th>Dias actuales:</th>
            <td>1, 2, 19</td>
        </tr>
        <tr class="mes">
            <th>Nuevos dias</th>
            <form action="#" name="edicion">
            <td><input type="text" id="nuevosDias" ></input></td>            
        </tr>        
        <tr>
            <td>
                <input type="buttom" value="Enviar" class="btn btn-primary" id="enviar"> 
                </form>
            </td>
        </tr>
    </tbody>
</table>

</div>
<script>

    function procesar(){
        alert('procesando');
    }

    nuevosDias = document.getElementById("nuevosDias");
    enviar = document.getElementById("enviar");
    enviar.addEventListener('click', procesar);
</script>
<?php

include_once ("./footer.php");

?>

<?php

include_once("./encabezado.php");
include_once(__DIR__ . "./../controller/classFecha.php");
include_once (__DIR__ . "./../controller/classFeriado.php");

if(isset($_GET['reg'])){
    $fecha = $_GET['reg'];
    
    $añoTexto = substr($fecha, 0, 4);
    $mesTexto = substr($fecha, 5);
    
    $objFeriado = new Feriado();

    $dias = $objFeriado->getMes($añoTexto, $mesTexto);

    $diaMaximo = Fecha::getDiasPermitidos($añoTexto, $mesTexto);

}

?>

<div class="container">
<br><br>
<div><h1>Edición de dias</h1></div>
<br>
<table class="table">
    <thead>
        <th class="añoEdicion"><h2>Año <?php echo $añoTexto?></h2></th>
    </thead>
    <tbody>
        <tr class="mes">
            <th>Mes:</th>
            <th><?php echo $mesTexto?></th>
        </tr>
        <tr class="mes">
            <th>Dias actuales:</th>
            <td><?php echo implode(", ", $dias); ?></td>
        </tr>
        <tr class="mes">
            <th>Nuevos dias</th>
            <form action="#" id="formulario" method="post">
            <td><input type="text" id="nuevosDias" name="dias"></input></td>                        
        </tr>        
        <tr>
            <td>
                <input type="submit" value="Enviar" class="btn btn-primary" id="enviar" disabled> 
                </form>
            </td>
            <td id='mensajeError' class='mensajeError'></td>
        </tr>
    </tbody>
</table>

</div>
<script>

    function borrarAdvertencia(){
        mensajeError.innerHTML = null;
        enviar.disabled=true;
    }

    function reportarResultado(resultado){
        if(data){
            mensajeError.innerHTML = "<span>edicón exitosa</span>";            
        }
    }

    function procesar(e){
        e.preventDefault();
        const respuesta = confirm("Estas seguro de actualizar este mes con estos dias?");
        if (respuesta){
            
            const params = {
                fecha: fecha,
                dias: listaNuevosDias
            };            

            const options = {
                method: "POST",
                headers: {"Content-type": "application/json"},
                body: JSON.stringify(params)                
            };
            
            //var datos = new FormData(formulario);

            //datos.append('fecha', fecha);

            url = "http://10.150.11.96:9012/controller/actualizarMes.php";
            
            fetch(url, {
                method: 'POST',                
                body: datos
            })
                .then(response => resultado.json())
                .then(data => reportarResultado)
        }else{
            nuevosDias.focus();
        }
        
    }

    function evaluarEntrada(){        
        
        const listaNuevosDiasTexto = nuevosDias.value.split(',');
        listaNuevosDias = listaNuevosDiasTexto.map(numero=>parseInt(numero));
        const conjuntoNuevosDias = new Set(listaNuevosDias); //Elimina duplicados
        
        const maximo = Math.max(...listaNuevosDias);

        const noValidos = listaNuevosDias.filter(numero=> isNaN(numero));
        
        if ((noValidos.length > 0) && (nuevosDias.value.length > 0)){
            mensajeError.innerHTML = "<span>debe añadir los días feriados en números separados por comas</span>";
            nuevosDias.focus();
            return;
        }
        
        if(Array.from(conjuntoNuevosDias).length != listaNuevosDias.length){
            mensajeError.innerHTML = "<span>hay días repetidos</span>";                
                nuevosDias.focus();
                return;
        }        

        if (maximo > diaMaximo){
            mensajeError.innerHTML = "<span>no debe añadir un día mayor a " + diaMaximo + "</span>";                
            nuevosDias.focus();
            return;            
        }

        enviar.disabled=false;
        enviar.focus();
        mensajeError.innerHTML =null;
        
    }

    function enter(e){
        if (e.key === "Enter"){
            evaluarEntrada();
        }
    }
    
    var listaNuevosDias;
    var fecha = "<?php echo $fecha ?>";
    formulario = document.getElementById('formulario');
    formulario.addEventListener('submit', e => {procesar(e)});
    mensajeError = document.getElementById('mensajeError');
    diaMaximo = <?php echo $diaMaximo ?>; 
    nuevosDias = document.getElementById("nuevosDias");
    enviar = document.getElementById("enviar");
    enviar.addEventListener('click', procesar);
    nuevosDias.addEventListener('focus', borrarAdvertencia);
    nuevosDias.addEventListener('keypress', enter);

</script>

<?php

include_once ("./footer.php");

?>

<?php

include_once ("./encabezado.php");
include_once(__DIR__ ."./../contantes.php");

$feriados = file_get_contents(GET_ALL_FERIADOS);

$arregloFeriados = json_decode($feriados, true);


?>

<div class="container">
<br><br>
<div><h1>Dias Feriados por año y mes</h1></div>
<br>
<div>
    <?php foreach($arregloFeriados as $año=>$meses){?>
    <table class="table table-striped"  id="<?php echo $año?>">
        <thead>                
            <tr>
                <th class="año">
                <?php echo "Año: " . $año; ?>
                </th>
            </tr>           
        </thead>
        <tbody>
            <?php foreach($meses as $mes=>$dias){ ?>
            <tr class="mes">
                <td >
                    <?php echo $mes; ?>
                </td>
                <td>
                    <?php echo implode(", ", $dias); ?>
                </td>
                <td class="edit" id='<?php echo $año . "-" . $mes; ?>'>
                    edit
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php 
        echo "<br>";
        }  
    ?>
</div>


</div>
<script>
    
    meses = document.getElementsByClassName("edit");

    function iden(mes){
        alert(mes.id);
    }
    
    for (let i=0; i<meses.length; i++){
            meses[i].addEventListener('click', function() {
                iden(meses[i]);
        });
    }

</script>
<?php
include_once ("./footer.php");
?>
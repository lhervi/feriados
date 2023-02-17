<?php

date_default_timezone_set("America/Caracas");

class Fecha{

    static function getCurrentYear(){
        $ahora=getdate();
        return $ahora['year'];       
    }

    static function getCurrentMonth(){
        $ahora=getdate();
        return $ahora['mon'];       
    }

    static function getPastMonth(){
        $ahora=getdate();
        $pastMonth = $ahora['mon']-1;
        if ($pastMonth == 0){
            $pastMonth = 12;
        }
        return $pastMonth;       
    }
    
    static function yearOk($año){
        $añoActual = self::getCurrentYear();
        if(abs($añoActual-$año) > 2 || $año > $añoActual){
            return false;
        }else{
            return true;
        }
    }

    static function monthOk($mes){
        $mesActual = self::getCurrentMonth();
        if(abs($mesActual-$mes)>11){
            return false;
        }else{
            return true;
        }
    }    
    
    static function getFechaYHoraCompleta(){
        $ahora=getdate();
        $fec = $ahora['year'] . "/" . $ahora['mon'] . "/" . $ahora['mday'] . " " . $ahora['hours'] . ":"  . $ahora['minutes'];
        return $fec;
    }

    static function getMesDeStringANumero(string $mes){
        $meses =['enero'=>1, 'febrero'=>2, 'marzo'=>3, 'abril'=>4,'mayo'=>5,'junio'=>6,
                'julio'=>7, 'agosto'=>8,'septiembre'=>9,'octubre'=>10, 'noviembre'=>11, 'diciembre'=>12];
        if(isset($meses[$mes])){
            return $meses[$mes];
        }else{
            $error['error'] = true;
            $error['mensaje'] = "no se encuentra un mes con ese nombre";
            return $error;
        }
    }

    static function getMesDeNumeroAString(int $mes){
        $meses =['enero','febrero', 'marzo', 'abril','mayo','junio',
                'julio', 'agosto','septiembre','octubre', 'noviembre', 'diciembre'];
        if($mes>=1 && $mes<=12){
            return $meses[$mes-1];
        }else{
            $error['error'] = true;
            $error['mensaje'] = "no se encuentra un mes con ese nombre";
            return $error;
        }
    }
}

class DiaDeSemana{
    private bool $error;
    private bool $finDeSemana;
    private string $dia;
    private string $mensaje;
    private int $unixTimeStamp;
    function __construct(string $fecha, $tipo="Y/m/d")
    {
        $finesDeSemana = ['Saturday', 'Sunday'];
        $this->finDeSemana = false;
        $this->error = true;
        
        if($tipo == "Y/m/d"){
            $dtime = DateTime::createFromFormat("Y/m/d" , $fecha);
        }elseif($tipo == "d/m/Y"){
            $dtime = DateTime::createFromFormat("d/m/Y" , $fecha);
        }elseif($tipo == "m/d"){
            $dtime = DateTime::createFromFormat("m/d" , $fecha);
        }elseif($tipo == "d/m"){
            $dtime = DateTime::createFromFormat("d/m" , $fecha);
        }else{
            $this->error = true;
            $this->mensaje = "el formato fecha no es válido";
        }

        if($dtime){
            $fechaTimeStamp= $dtime->getTimestamp();
            $dayArray = getdate($fechaTimeStamp);              
            $this->dia = $dayArray['weekday'];
            $this->error = false;
            if(in_array($dayArray['weekday'], $finesDeSemana)){
                $this->finDeSemana = true;                                    
            }
        }else{
            $this->error = true;
            $this->mensaje = "no fue posible convertir la cadena a formato fecha";
        }
    }
    function getError():bool{
        return $this->error;
    }
    function getErrorMensaje():string{
        return $this->mensaje;
    }
    function esFinDeSemana():bool{
        return $this->finDeSemana;
    }
    function getDia():string{
        return $this->dia;
    }
    function getUnixTimeStamp():bool{
        return $this->unixTimeStamp;
    }

}

class FinesDeSemana {
    static function getFinesDeSemana(int $año, string $tipo="Y/m/d"):array{
        $fec = strval($año) . "/01/01";
        // $dtime = DateTime::createFromFormat("Y/m/d" , $fecha);
        // $fechaTimeStamp= $dtime->getTimestamp();
        $dtime=DateTime::createFromFormat($tipo, $fec);
        $fechaTimeStamp= $dtime->getTimestamp();
        $dayArray = getdate($fechaTimeStamp); // Ej. 2022/01/01        
        
        $mesControl=1;
        $finesDeSemana=array();

        foreach (range(1, 12) as $mes){
            $finesDeSemana[$mes]=array();
            foreach (range(1, 31) as $dia){

                $day = $dayArray['weekday'];
                
                if($mesControl == $dayArray['mon'] && ($day == 'Saturday' || $day == 'Sunday')){
                    array_push($finesDeSemana[$mes], $dia);
                }

                $dtime->add(new DateInterval('P1D'));
                
                $fechaTimeStamp= $dtime->getTimestamp();
                $dayArray = getdate($fechaTimeStamp);
                
                $diaDelMes = $dayArray['mon'];
                if($diaDelMes != $mes){    
                    $mesControl +=1;                
                    break;
                }
            }
        }
        return $finesDeSemana;
    }
}

$fec = function(){
    return strval(Fecha::getFechaYHoraCompleta());
};


?>
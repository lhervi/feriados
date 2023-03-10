<?php

date_default_timezone_set("America/Caracas");

class Fecha{

    static function getDiasPermitidos(string $añoTexto, string $mesTexto){
        
        $año = intval($añoTexto);
        $mes = self::getMesDeStringANumero($mesTexto);       
        
        $meses31 = [1, 3, 5, 7, 8, 10, 12];
        $meses30 = [4, 6, 9, 11];

        if (in_array($mes, $meses31)){
            return 31;
        }elseif(in_array($mes, $meses30)){
            return 30;
        }

        $ultimoDiaFebrero = $añoTexto . "-02-28";
        $date = new DateTimeImmutable($ultimoDiaFebrero);
        $diaSiguiente = $date->add(new DateInterval('P1D'));
        $mesConUnDiaMas = $diaSiguiente->format('m');
        
        if ($mesConUnDiaMas == intval($mesTexto)){
            return 29;
        }else{
            return 28;
        }
    }
    
    static function getAñoMesEnEnteros(string $fecha):array{
        //2022-febrero
        $añoTexto = substr($fecha, 0, 4);
        $mesTexto = substr($fecha, 5);
        
        $año = intval($añoTexto);
        $mes = self::getMesDeStringANumero($mesTexto);

        $añoMes = ['año'=>$año, 'mes'=>$mes];

        return $añoMes;
    }

    static function getMesEnLetras(int $mesEnNumeros):string{
        
        $mesEnLetras="";
        
        if($mesEnNumeros>=1 && $mesEnNumeros<=12){
            $meses=self::getListaMeses(false);    
            return $meses[$mesEnNumeros];
        }
        return $mesEnLetras;
       
    }
    
    static function getMesEnNumero(string $mesEnLetras):int{
        
        $meses=self::getListaMeses(false);    
        $mesEnLetras = ucfirst($mesEnLetras);
        
        $mesEnNumero = array_search($mesEnLetras, $meses);     
           
        return $mesEnNumero;
       
    }

    static function getListaDias(){
        $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        return $dias;
    }

    static function getListaMeses(bool $indiceEnMeses, $upper=true):array{
        
        $meses = ['enero'=>'Enero', 'febrero'=>'Febrero', 'marzo'=>'Marzo', 
            'abrol'=>'Abril', 'mayo'=>'Mayo', 'junio'=>'Junio', 
            'julio'=>'Julio', 'agosto'=>'Agosto', 'septiembre'=>'Septiembre', 
            'octubre'=>'Octubre', 'noviembre'=>'Noviembre', 'diciembre'=>'Diciembre'];

        if ($indiceEnMeses){
            return $meses;
        }else{
            $prov=array();
            $prov[0]=null;
            foreach($meses as $mes){
                $prov[]=$mes;
            }
            unset($prov[0]);
            $meses = $prov;
        }
        if ($upper){
            return $meses;
        }else{
            return array_map(fn($mes)=>strtolower($mes), $meses);
        }
        
    }
    
    static function getAñoDelMes(int $mes):int{
        if($mes>=1 && $mes<=12){
            $fechaActual = getdate();
            $mesActual = $fechaActual['mon'];
            if($mesActual>$mes){
                return $fechaActual['year'];
            }else{
                return $fechaActual['year']-1;
            }
        }else{
            return -1;
        }    
          
    }

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
        if($mes<1 || $mes>12){
            return false;
        }
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
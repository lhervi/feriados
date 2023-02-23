<?php

class Feriado{

    static array $años;

    function __construct(string $file=""){
    
        include_once (__DIR__ . "./../contantes.php");
        
        if ($file == ""){
            $file = FERIADOS_JSON;
        }

        $feriadosFile = file_get_contents($file);

        self::$años = json_decode($feriadosFile, true);

    }

    function saveFeriados(){
        $añosJson = json_encode(self::$años, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        $result = file_put_contents(FERIADOS_JSON, $añosJson);
        return $result;
    }

    function allYear(){
        return self::$años;
    }

    function allYearJson(){
        return json_encode(self::$años, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    }
    
    function getYear(string $año){
        return self::$años[$año];
    }

    function getYearJson(string $año){
        return json_encode(self::$años[$año], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    }    

    function getMes(string $año, string $mes){
        return self::$años[$año][$mes];
    }

    function getMesJson(string $año, string $mes){
        return json_encode(self::$años[$año][$mes],  JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    }

    function setMonth(string $año, string $mes, array $dias){        
        self::$años[$año][$mes] = $dias;        
        $result = $this->saveFeriados();
        if ($result){
            return true;
        }else{
            return false;
        }        
    }

}


?>
<?php

//formatea un numero estilo español
function numero_es($numero)
{    
    return number_format($numero,2,',','.');    
}
//devuelve la fecha local formateada para events
function ahora()
{    
    //gmDate("Y-m-d\TH:i:s\Z")
    //return gmdate(DATE_ISO8601); fecha GMT
    //return date("Y-m-d\TH:i:s\Z",  time()); //fecha local
    return date(DATE_ISO8601,  time()); //fecha local 
}

function valida_input($data)
{    
    return trim(htmlspecialchars(strip_tags(stripslashes($data)), ENT_QUOTES, 'UTF-8'));
}

//devuelve una cadena de texto para presentar en pantalla
function fecha_es()
{
    
    $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
   $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
       'Miercoles', 'Jueves', 'Viernes', 'Sabado');
     
   $hora = date('H').':'.date('m').':'.date('s');
    echo $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y').', a '.$hora;

}

function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}

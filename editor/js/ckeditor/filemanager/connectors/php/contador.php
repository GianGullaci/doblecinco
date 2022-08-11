<?php
$IP = getenv("REMOTE_ADDR");
$host = gethostbyaddr($IP);
$dat3=date("D M d, Y g:i a");
$agente = $_SERVER["HTTP_USER_AGENT"];

function ObtenerNavegador($user_agent) {
     $navegadores = array(
          'Opera' => 'Opera',
          //'Mozilla Firefox'=> '(Firebird)|(Firefox)',
		  'Mozilla Firefox 2'=> '(Firebird)|(Firefox/2)',
		  'Mozilla Firefox 3'=> '(Firebird)|(Firefox/3)',
          'Galeon' => 'Galeon',
          'Mozilla'=>'Gecko',
          'MyIE'=>'MyIE',
          'Lynx' => 'Lynx',
          'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
          'Konqueror'=>'Konqueror',
          'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
          'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
          'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
          'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
	);
foreach($navegadores as $navegador=>$pattern){
       if (eregi($pattern, $user_agent))
       return $navegador;
    }
return 'Desconocido';
}

$msg = "[Host/IP]: $host - $IP || [Navegador]: ".ObtenerNavegador($agente)." || [Date]: $dat3
";


$fp = fopen("update.txt","r");//comprobar si ia descargo desde una ip
$leer = fread($fp, 900000);
fclose($fp);

if(ereg($IP, $leer)){//si hay coincidencias porke encuentra la ip, entonces no guardamos

}else{//aun no descargo, entonces guardamos

$archivo    =    "update.txt";
    if (!$abrir = fopen($archivo, "a")) {
         echo  "Error ($archivo)";
         exit;
    }
    
    if (!fwrite($abrir, $msg)) {
        ;
        exit;
    }
    
    fclose($abrir);
}//fin coincidencias
?>
<?php  
   date_default_timezone_set('America/Mexico_City');
     $conecta =  mysqli_connect('localhost', 'unidsyst_mp', 'MaplinGPS', 'unidsyst_mp');
     if(!$conecta){
         die('no pudo conectarse:' . mysqli_connect_error());
}
   if (!mysqli_set_charset($conecta,'utf8')) {
    die('No pudo conectarse: ' . mysqli_error($conecta));
}
?>
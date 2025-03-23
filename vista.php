<?php
if(!empty($_GET['imagen'])){
    //Credenciales de conexion
    $Host = 'localhost';
    $Username = 'unidsyst_mp';
    $Password = 'MaplinGPS';
    $dbName = 'unidsyst_mp';
    
    //Crear conexion mysql
    $db = new mysqli($Host, $Username, $Password, $dbName);
    
    //revisar conexion
    if($db->connect_error){
       die("Connection failed: " . $db->connect_error);
    }
        //Extraer imagen de la BD mediante GET
    $result = $db->query("SELECT imagenes FROM directorio WHERE imagen = {$_GET['imagen']}");
    
    if($result->num_rows > 0){
        $imgDatos = $result->fetch_assoc();
        
        //Mostrar Imagen
        header("Content-type: image/jpg"); 
        echo $imgDatos['imagenes']; 
    }else{
        echo 'Imagen no existe...';
    }
}
?>
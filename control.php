<?php
session_start();
 require_once("conexion.php"); 
       /* El query valida si el usuario ingresado existe en la base de datos. Se utiliza la función 
     htmlentities para evitar inyecciones SQL. */
	  $miusuario  = $_POST['usuario'];
	  $password   = $_POST['clave'];
	  $miuser     = htmlentities($miusuario);
	  $miclave    = md5(htmlentities($password));
	  $myusuario  = "select idusuario from usuarios where idusuario = '$miuser'";
	  $validacion = mysqli_query($conecta,$myusuario); 
	  $nmyusuario = mysqli_num_rows($validacion);      	
     //Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario...
     if($nmyusuario != 0){
	     $sql = "select * from usuarios where estado = 1 and idusuario = '$miuser' and clave = '$miclave'";             
		 $myclave = mysqli_query($conecta,$sql);
		 $nmyclave = mysqli_num_rows($myclave);
		 //Si el usuario y clave ingresado son correctos (y el usuario está activo en la BD), creamos la sesión del mismo.
          if($nmyclave != 0)
				{
               $_SESSION['autentica'] = "SIP";
			   $_SESSION['usuarioactual'] = $miuser; //nombre del usuario logueado.
			   $user=$_SESSION['usuarioactual'];
			   $ensesion="UPDATE usuarios SET login=1 WHERE idusuario='$user'";
                mysqli_query($conecta,$ensesion);
				$cadena=$_SESSION['usuarioactual'];
				$buscar="Maplin";
			    $palabra = stripos($cadena,$buscar);
			   	if($palabra!==FALSE){
                header("Location: inicio.php");
				}
			   	else{
                header("Location: inicio.php");}
                }
                else{
               echo"<script>alert('La contraseña del usuario no es correcta, verifique también su departamento');
               window.location.href=\"inicio_sesion.php\"</script>"; 
               }
     }else{
          echo"<script>alert('El usuario no existe');window.location.href=\"inicio_sesion.php\"</script>";
     }
     mysqli_close($conecta);
?>
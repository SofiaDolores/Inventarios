<?php
include 'conexion.php'; // Incluye el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $id = intval($_POST['id']);
    $folio = mysqli_real_escape_string($conecta, $_POST['folio']);
    $nombre = mysqli_real_escape_string($conecta, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conecta, $_POST['telefono']);
    $costos = mysqli_real_escape_string($conecta, $_POST['costos']);
    $url_imagen = mysqli_real_escape_string($conecta, $_POST['url_imagen']);
    $notas = mysqli_real_escape_string($conecta, $_POST['notas']);

    // Procesar imagen si se subió
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = mysqli_real_escape_string($conecta, file_get_contents($_FILES['imagen']['tmp_name']));
    }

    // Construir consulta de actualización
    $query = "UPDATE directorio SET 
                folio = '$folio', 
                nombre = '$nombre', 
                telefono = '$telefono', 
                costos = '$costos', 
                url_imagen = '$url_imagen', 
                notas = '$notas'" . 
              ($imagen ? ", imagen = '$imagen'" : "") . 
              " WHERE id = $id";

    // Ejecutar consulta
    if (mysqli_query($conecta, $query)) {
        echo "Registro actualizado con éxito.";
    } else {
        echo "Error al actualizar: " . mysqli_error($conecta);
    }
}
?>

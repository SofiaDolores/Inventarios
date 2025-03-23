<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "unidsyst_mp";
$password = "MaplinGPS";
$dbname = "unidsyst_mp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener la imagen de la base de datos
$id = $_GET['id']; // Asumiendo que pasas el ID de la imagen a través de la URL
$sql = "SELECT imagen FROM directorio WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($imagen);
$stmt->fetch();

// Si existe la imagen, la mostramos
if ($stmt->num_rows > 0) {
    header("Content-type: imagen"); // Cambiar el tipo de contenido según el formato de la imagen
    echo $imagen; // Mostrar la imagen
} else {
    echo "No se encontró la imagen.";
}

$stmt->close();
$conn->close();
?>

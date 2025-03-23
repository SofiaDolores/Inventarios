<?php
// Conexión a la base de datos
require_once("conexion.php");

// Consulta SQL para obtener los datos
$sql = "SELECT fecha, piezas, material FROM insumos";
$result = mysqli_query($conecta, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conecta));
}

// Preparar datos
$fechas = [];
$piezas = [];
$materiales = [];
while ($row = mysqli_fetch_assoc($result)) {
    $fechas[] = $row['fecha'];
    $piezas[] = $row['piezas'];
    $materiales[] = $row['material'];
}

// Crear respuesta JSON
echo json_encode([
    "fechas" => $fechas,
    "piezas" => $piezas,
    "materiales" => $materiales
]);
?>

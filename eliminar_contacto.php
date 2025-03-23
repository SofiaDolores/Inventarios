<?php
include 'conexion.php';
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir el ID a entero para mayor seguridad

    // Preparar la consulta para eliminar
    $sql = "DELETE FROM directorio WHERE id = ?";
    $stmt = $conecta->prepare($sql);

    // Ejecutar la consulta con el ID recibido
    if ($stmt->execute([$id])) {
        // Redirigir al usuario a la página de directorio_contactos.php después de eliminar
        header('Location: directorio_contactos.php');
        exit();
    } else {
        // En caso de error, mostrar un mensaje
        echo "Error al eliminar el contacto.";
    }
} else {
    echo "No se recibió un ID válido.";
}
?>

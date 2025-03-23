<?php
// Configuración inicial
date_default_timezone_set('America/Mexico_City');
$conecta = mysqli_connect('localhost', 'unidsyst_mp', 'MaplinGPS', 'unidsyst_mp');
if (!$conecta) {
    die('No pudo conectarse: ' . mysqli_connect_error());
}
mysqli_set_charset($conecta, 'utf8');
require('fpdf.php');

// Obtener parámetros GET (año y mes)
$year = isset($_GET['year']) ? intval($_GET['year']) : null;
$month = isset($_GET['month']) ? str_pad(intval($_GET['month']), 2, '0', STR_PAD_LEFT) : null;

if (!$year || !$month || $year < 2024 || $month < 1 || $month > 12) {
    die('Año o mes no válidos.');
}

// Clase PDF
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('lin.png', 5, 5, 50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 12, utf8_decode('Reporte de Inventario - Año ' . $_GET['year'] . ', Mes ' . $_GET['month']), 0, 1, 'C');
        $this->Ln(5);
        $this->Cell(25, 10, 'Folio', 1);
        $this->Cell(28, 10, 'Fecha', 1);
        $this->Cell(20, 10, 'Hora', 1);
        $this->Cell(30, 10, 'Material', 1);
        $this->Cell(36, 10, 'Piezas Totales', 1);
        $this->Cell(40, 10, 'Fecha de Surtido', 1);
        $this->Cell(64, 10, 'Notas', 1);
        $this->Cell(38, 10, 'Estado de Stock', 1);
        $this->Ln();
    }
}

// Consultar registros filtrados por año y mes
$sql = "SELECT * FROM insumos WHERE YEAR(fecha) = $year AND MONTH(fecha) = $month";
$result = mysqli_query($conecta, $sql);

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', '', 10);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(25, 10, utf8_decode($row['folio']), 1);
    $pdf->Cell(28, 10, utf8_decode($row['fecha']), 1);
    $pdf->Cell(20, 10, utf8_decode($row['hora']), 1);
    $pdf->Cell(30, 10, utf8_decode($row['material']), 1);
    $pdf->Cell(36, 10, utf8_decode($row['piezas']), 1);
    $pdf->Cell(40, 10, utf8_decode($row['fechasu']), 1);
    $pdf->Cell(64, 10, utf8_decode($row['notas']), 1);

    $estado_stock = $row['piezas'] <= 10 ? 'Stock Bajo' : 'En Stock';
    $pdf->Cell(38, 10, utf8_decode($estado_stock), 1);
    $pdf->Ln();
}

mysqli_free_result($result);
mysqli_close($conecta);

// Generar el PDF
$pdf->Output('I', "reporte_inventario_${year}_${month}.pdf");
?>

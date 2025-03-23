<?php
date_default_timezone_set('America/Mexico_City');
$conecta = mysqli_connect('localhost', 'unidsyst_mp', 'MaplinGPS', 'unidsyst_mp');
if (!$conecta) {
    die('No pudo conectarse: ' . mysqli_connect_error());
}
mysqli_set_charset($conecta, 'utf8');

require('fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('lin.png', 5, 5, 50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 12, 'Reporte de Inventario', 0, 1, 'C');
        $this->Ln(5);
        $this->Cell(22, 10, 'Folio', 1);
        $this->Cell(30, 10, 'Fecha', 1);
        $this->Cell(20, 10, 'Hora', 1);
        $this->Cell(35, 10, 'Material', 1);
        $this->Cell(38, 10, 'Piezas Totales', 1);
        $this->Cell(40, 10, 'Fecha de Surtido', 1);
        $this->Cell(45, 10, 'Notas', 1);
        $this->Cell(45, 10, 'Fecha Actualizacion', 1);
        $this->Ln();
    }
}

$sql = "SELECT * FROM historial_insumos";
$result = mysqli_query($conecta, $sql);

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', '', 10);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(22, 10, $row['folio'], 1);
    $pdf->Cell(30, 10, $row['fecha'], 1);
    $pdf->Cell(20, 10, $row['hora'], 1);
    $pdf->Cell(35, 10, $row['material'], 1);
    $pdf->Cell(38, 10, $row['piezas'], 1);
    $pdf->Cell(40, 10, $row['fechasu'], 1);
    $pdf->Cell(45, 10, $row['notas'], 1);
	$pdf->Cell(45, 10, $row['fecha_actualizacion'], 1);
    $pdf->Ln();
}

mysqli_free_result($result);
mysqli_close($conecta);

$pdf->Output('I', 'reporte_inventario.pdf');
?>
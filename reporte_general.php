<?php
   date_default_timezone_set('America/Mexico_City');
     $conecta =  mysqli_connect('localhost', 'unidsyst_mp', 'MaplinGPS', 'unidsyst_mp');
   if (!mysqli_set_charset($conecta,'utf8')) {
    die('No pudo conectarse: ' . mysqli_connect_error());
    }
require('fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('lin.png', 5, 5, 50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Inventario', 0, 1, 'C');
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

$limite_stock_bajo = 10;

// Consultar los productos
$sql = "SELECT * FROM insumos";
$result = mysqli_query($conecta, $sql);

// Crear un nuevo PDF
$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', '', 10);

// Definir el límite para stock bajo
$limite_stock_bajo = 10; // Puedes ajustar este valor según tu necesidad

// Recorrer las filas de resultados
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(25, 10, $row['folio'], 1);
    $pdf->Cell(28, 10, $row['fecha'], 1);
    $pdf->Cell(20, 10, $row['hora'], 1);
    $pdf->Cell(30, 10, $row['material'], 1);
    $pdf->Cell(36, 10, $row['piezas'], 1);
    $pdf->Cell(40, 10, $row['fechasu'], 1);
    $pdf->Cell(64, 10, $row['notas'], 1);

    // Determinar estado de stock
    $estado_stock = $row['piezas'] <= $limite_stock_bajo ? 'Stock Bajo' : 'En Stock';
    $pdf->Cell(38, 10, $estado_stock, 1);
    $pdf->Ln();
}
// Salida del archivo PDF
$pdf->Output('I', 'Reporte_Inventario_general.pdf');
?>
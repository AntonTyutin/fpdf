<?php
require('htmlcolor.php');

$pdf = new PDF_HTMLColor();
$pdf->AddPage();
$pdf->SetDrawColor('blue');
$pdf->SetFillColor('#EE6060');
$pdf->SetTextColor('yellow');
$pdf->SetLineWidth(1);
$pdf->SetFont('Arial','',16);
$pdf->SetXY(80,40);
$pdf->Cell(50,20,'HTML Colors',1,0,'C',true);
$pdf->Output();
?>

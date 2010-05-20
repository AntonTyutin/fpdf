<?php
require('dashed_rect.php');

$pdf=new PDF_DashedRect();
$pdf->AddPage();
$pdf->SetDrawColor(200);
$pdf->DashedRect(40,30,165,60);
$pdf->SetFont('Arial','B',30);
$pdf->SetXY(40,30);
$pdf->Cell(125,30,'Enjoy dashes!',0,0,'C');
$pdf->Output();
?>

<?php
require('force_justify.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','U',10);
$pdf->SetFillColor(250,180,200);
//Set the interior cell margin to 1cm
$pdf->cMargin=10;
//Print 2 Cells
$pdf->Cell(190,8,'a short text which is left aligned',1,1,'L',1);
$pdf->Ln();
$pdf->Cell(190,8,'a short text which is forced justified',1,1,'FJ',1);
$pdf->Ln();
//Print 2 MultiCells
$y=$pdf->GetY();
$pdf->MultiCell(90,8,"It is a long text\nwhich is left aligned",1,'L',1);
$pdf->SetXY(110,$y);
$pdf->MultiCell(90,8,"It is a long text\nwhich is forced justified",1,'FJ',1);
$pdf->Output();
?>

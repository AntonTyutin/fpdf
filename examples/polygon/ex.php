<?php
require('polygon.php');

$pdf=new PDF_Polygon();
$pdf->AddPage();
$pdf->SetDrawColor(255,0,0);
$pdf->SetFillColor(0,0,255);
$pdf->SetLineWidth(4);
$pdf->Polygon(array(50,115,150,115,100,20),'FD');
$pdf->Output();
?>

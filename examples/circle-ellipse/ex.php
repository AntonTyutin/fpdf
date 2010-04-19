<?php
require('ellipse.php');

$pdf=new PDF_Ellipse();
$pdf->AddPage();
$pdf->Ellipse(100,50,30,20);
$pdf->SetFillColor(255,255,0);
$pdf->Circle(110,47,7,'F');
$pdf->Output();
?>

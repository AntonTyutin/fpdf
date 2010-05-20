<?php
require('spotcolor.php');

$pdf=new PDF_SpotColor();
$pdf->AddSpotColor('PANTONE 145 CVC',0,42,100,25);
$pdf->AddPage();
$pdf->SetFillSpotColor('PANTONE 145 CVC');
$pdf->Rect(80,40,50,50,'F');
$pdf->Output();
?>

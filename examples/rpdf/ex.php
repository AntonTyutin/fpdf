<?php
require('rpdf.php');

$pdf=new RPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',40);
$pdf->TextWithRotation(50,65,'Hello',45,-45);
$pdf->SetFontSize(30);
$pdf->TextWithDirection(110,50,'world!','L');
$pdf->TextWithDirection(110,50,'world!','U');
$pdf->TextWithDirection(110,50,'world!','R');
$pdf->TextWithDirection(110,50,'world!','D');
$pdf->Output();
?>

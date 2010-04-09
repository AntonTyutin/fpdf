<?php
require('star.php');

$pdf = new PDF_Star();
$pdf->AddPage();
$pdf->SetDrawColor(0,0,0);
$pdf->SetFillColor(255,0,0);
$pdf->SetLineWidth(0.5);
$pdf->Star(100,60,40,30,36,'DF');
$pdf->Output();
?>

<?php
require('rounded_rect.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetLineWidth(0.5);
$pdf->SetFillColor(192);
$pdf->RoundedRect(70, 30, 68, 46, 3.5, 'DF');
$pdf->Output();
?>

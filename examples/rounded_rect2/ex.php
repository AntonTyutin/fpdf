<?php
require('rounded_rect2.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFillColor(192);
$pdf->RoundedRect(60, 30, 68, 46, 5, '13', 'DF');
$pdf->Output();
?>

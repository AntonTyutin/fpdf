<?php
require('fpdf-wmf.php');

$pdf = new FPDF_WMF();
$pdf->AddPage();
$pdf->ImageWMF('ringmaster.wmf', 55, 10, 110);
$pdf->Output();
?>

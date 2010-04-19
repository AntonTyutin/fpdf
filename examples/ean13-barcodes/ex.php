<?php
require('ean13.php');

$pdf=new PDF_EAN13();
$pdf->AddPage();
$pdf->EAN13(80,40,'123456789012');
$pdf->Output();
?>

<?php
require('pdf_codabar.php');

$pdf=new PDF_Codabar();
$pdf->AddPage();
$pdf->Codabar(75,40,'123456789');
$pdf->Output();
?>

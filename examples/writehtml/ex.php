<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
$pdf->Output();
?>

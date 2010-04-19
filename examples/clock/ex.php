<?php
require('clock.php');

$pdf=new PDF_Clock();
$pdf->AddPage();
$pdf->Clock(105,65,50);
$pdf->Output();
?>

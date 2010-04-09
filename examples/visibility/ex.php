<?php
require('visibility.php');

$pdf=new PDF_Visibility();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->SetVisibility('screen');
$pdf->Write(6,"This line is for display.\n");
$pdf->SetVisibility('print');
$pdf->Write(6,"This line is for printout.\n");
$pdf->SetVisibility('all');
$pdf->Output();
?>

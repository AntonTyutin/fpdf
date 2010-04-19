<?php
require('justification.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->Cell(85,4,"EXAMPLE OF FUNCTION USAGE",1,1,'C');
$pdf->Write(4,"\nSource: http://www.swg-fr.com\n\n");
$text=file_get_contents('ex.txt');
$pdf->Justify($text,85,4);
$pdf->Output();
?>

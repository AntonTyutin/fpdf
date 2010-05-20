<?php
require('cells_bold.php');

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$text  = "Let's show... \n\n";
$text .= " [This is a cell][and another cell]\n\n";
$text .= "<This is a bold sentence> and another non bold sentence.";
$pdf->WriteText($text);
$pdf->Output();
?>

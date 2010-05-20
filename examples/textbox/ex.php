<?php
require('textbox.php');

$pdf=new PDF_TextBox();
$pdf->AddPage();
$pdf->SetFont('Arial','',15);
$pdf->SetXY(80,35);
$pdf->drawTextBox('This sentence is centered in the middle of the box.', 50, 50, 'C', 'M');
$pdf->Output();
?>

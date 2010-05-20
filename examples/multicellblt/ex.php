<?php
require('MultiCellBlt.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$column_width = ($pdf->w-30)/2;
$sample_text = 'This is bulleted text. The text is indented and the bullet appears at the first line only.';

for ($n=1; $n<=3; $n++)
	$pdf->MultiCellBlt($column_width,6,chr(149),$sample_text.' '.$sample_text);

for ($n=1; $n<=2; $n++)
	$pdf->MultiCellBlt($column_width,6,'>',$sample_text.' '.$sample_text);

$pdf->SetXY($column_width+10*2,10);
for ($n=1; $n<=10; $n++)
	$pdf->MultiCellBlt($column_width,6,"$n)",$sample_text);

$pdf->Output();
?>

<?php
require('MultiCellBlt2.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$column_width = $pdf->w-30;
$sample_text = 'This is bulleted text. The text is indented and the bullet appears at the first line only. This list is built with a single call to MultiCellBltArray().';

//Test1
$test1 = array();
$test1['bullet'] = chr(149);
$test1['margin'] = ' ';
$test1['indent'] = 0;
$test1['spacer'] = 0;
$test1['text'] = array();
for ($i=0; $i<5; $i++)
{
	$test1['text'][$i] = $sample_text;
}
$pdf->SetX(10);
$pdf->MultiCellBltArray($column_width-$pdf->x,6,$test1);
$pdf->Ln(10);

//Test 2
$test2 = array();
$test2['bullet'] = '>';
$test2['margin'] = ' ';
$test2['indent'] = 5;
$test2['spacer'] = 5;
$test2['text'] = array();
for ($i=0; $i<5; $i++)
{
	$test2['text'][$i] = $sample_text;
}
$pdf->SetX(20);
$pdf->MultiCellBltArray($column_width-$pdf->x,6,$test2);
$pdf->Ln(10);

//Test 3
$test3 = array();
$test3['bullet'] = 1;
$test3['margin'] = ')     ';
$test3['indent'] = 10;
$test3['spacer'] = 10;
$test3['text'] = array();
for ($i=0; $i<5; $i++)
{
	$test3['text'][$i] = $sample_text;
}
$pdf->SetX(30);
$pdf->MultiCellBltArray($column_width-$pdf->x,6,$test3);

$pdf->Output();
?>

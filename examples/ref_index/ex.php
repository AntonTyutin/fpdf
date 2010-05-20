<?php
require('ref_index.php');

//Sort function for references
//To be defined by the user to achieve desired results
//This function is case insensitive
function cmp($a, $b) {
    return strnatcmp(strtolower($a['t']), strtolower($b['t']));
}

$pdf=new PDF_Ref();
$pdf->SetFont('Arial','',15);

//Page 1
$pdf->AddPage();
$pdf->Cell(0,5,'Page 1',0,1,'C');
$pdf->Reference('A');
$pdf->Reference('B');
$pdf->Reference('R');

//Page 2
$pdf->AddPage();
$pdf->Cell(0,5,'Page 2',0,1,'C');
$pdf->Reference('R');
$pdf->Reference('a');
$pdf->Reference('A');
$pdf->Reference('g');
$pdf->Reference('G');
$pdf->Reference('N');
for ($i=1;$i<=200;$i++)
	$pdf->Reference('Ref'.$i);

//Alphabetic sort of the references
usort($pdf->Reference, 'cmp');

//Creation of index
$pdf->CreateReference(4);
$pdf->Output();
?>

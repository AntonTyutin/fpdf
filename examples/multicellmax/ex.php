<?php
require('multicellmax.php');

$pdf=new PDF();
$pdf->AddPage();
$txt='';
for ($i=1; $i<19; $i++)
	$txt.='all work and no play makes jack a dull boy ';
$pdf->Rect(20,20,100,100);
$pdf->Rect(80,20,40,40);
$pdf->Rect(20,80,40,40);
$pdf->SetXY(20,20);
$pdf->SetFont('Arial','',10);
$txt=$pdf->MultiCell(60,5,$txt,0,'J',0,8);
$txt=$pdf->MultiCell(100,5,$txt,0,'J',0,4);
$pdf->SetX(60);
$txt=$pdf->MultiCell(60,5,$txt,0,'J',0,8);
$pdf->Output();
?>

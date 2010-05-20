<?php
ini_set('memory_limit','100M');
ini_set('max_execution_time',0);

require('memory_opt.php');

$pdf = new PDF_Opt();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
// generate a constant amount of text for testing
$txt = '';
for($i=1; $i<200; $i++)
	$txt .= 'ashfsd kjsahkasjh akjhdsfjkh djshf sjkh ';
for($i=1; $i<1000; $i++)
	$pdf->Write(9,$txt);
$pdf->Output();
?>

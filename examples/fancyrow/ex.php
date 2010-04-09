<?php
require('fancyrow.php');

$pdf = new PDF_FancyRow();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Write(12,'Please fill in your name, company and email below:');
$pdf->Ln(20);
$widths = array(5, 40, 5, 40, 5, 40);
$border = array('', 'LBR', '', 'LBR', '', 'LBR');
$caption = array('','Name', '', 'Company','', 'Email');
$align = array('', 'C', '', 'C', '', 'C');
$style = array('', 'I', '', 'I', '', 'I');
$empty = array('','','','','','');
$pdf->SetWidths($widths);
$pdf->FancyRow($empty, $border);
$pdf->FancyRow($caption, $empty, $align, $style);
$pdf->Output();
?>

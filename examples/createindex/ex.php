<?php
require('createindex.php');

$pdf=new PDF_Index();
$pdf->SetFont('Arial','',15);

//Page 1
$pdf->AddPage();
$pdf->Bookmark('Section 1');
$pdf->Cell(0,6,'Section 1',0,1);
$pdf->Bookmark('Subsection 1',1,-1);
$pdf->Cell(0,6,'Subsection 1');
$pdf->Ln(50);
$pdf->Bookmark('Subsection 2',1,-1);
$pdf->Cell(0,6,'Subsection 2');

//Page 2
$pdf->AddPage();
$pdf->Bookmark('Section 2');
$pdf->Cell(0,6,'Section 2',0,1);
$pdf->Bookmark('Subsection 1',1,-1);
$pdf->Cell(0,6,'Subsection 1');

//Index
$pdf->AddPage();
$pdf->Bookmark('Index');
$pdf->CreateIndex();
$pdf->Output();
?>

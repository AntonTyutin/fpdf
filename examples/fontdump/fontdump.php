<?php
require('../../src/fpdf.php');

class PDF extends FPDF
{
var $col=0;

function SetCol($col)
{
	//Set position on top of a column
	$this->col=$col;
	$this->SetLeftMargin(10+$col*40);
	$this->SetY(25);
}

function AcceptPageBreak()
{
	//Go to the next column
	$this->SetCol($this->col+1);
	return false;
}

function DumpFont($FontName)
{
	$this->AddPage();
	//Title
	$this->SetFont('Arial','',16);
	$this->Cell(0,6,$FontName,0,1,'C');
	//Print all characters in columns
	$this->SetCol(0);
	for($i=32;$i<=255;$i++)
	{
		$this->SetFont('Arial','',14);
		$this->Cell(12,5.5,"$i : ");
		$this->SetFont($FontName);
		$this->Cell(0,5.5,chr($i),0,1);
	}
	$this->SetCol(0);
}
}

$pdf=new PDF();
$pdf->DumpFont('Arial');
$pdf->DumpFont('Symbol');
$pdf->DumpFont('ZapfDingbats');
$pdf->Output();
?>

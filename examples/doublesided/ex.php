<?php
require('doublesided.php');

class PDF extends DoubleSided_PDF
{
	function Header()
	{
		if ( $this->PageNo() % 2 == 0 ) {
			$this->Cell(30,0,$this->PageNo(),0,0,'L');
			$this->Cell(0,0,'This chapter has a title',0,0,'R');
		}
		else {
			$this->Cell(160,0,'Topic of this chapter',0,0,'L');
			$this->Cell(0,0,$this->PageNo(),0,2,'R');
		}
		//Line break
		$this->SetY(20);
		$this->SetLineWidth(0.01);
		$this->Line($this->lMargin, 18, 210 - $this->rMargin, 18);
		$this->Ln(15);
	}

	function Footer()
	{
		//Position at 1.5 cm from bottom
		$this->SetLineWidth(0.01);
		$this->Line($this->lMargin, 281.2, 210 - $this->rMargin, 281.2);
		$this->SetY(-10);
		//Page number
		$this->Cell(0,3,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetDoubleSided(20,10);
$pdf->SetFont('Arial','',12);
$pdf->AddPage();
for ($i=0; $i < 60; $i++ )
	$pdf->MultiCell(0, 10, str_repeat('a lot of text ',30)."...\n");
$pdf->SetDisplayMode('fullpage', 'single');
$pdf->Output();
?>

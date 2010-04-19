<?php
require('fpdf.php');

class PDF_Ref extends FPDF
{
var $RefActive=false;    //Flag indicating that the index is being processed
var $ChangePage=false;   //Flag indicating that a page break has occurred
var $Reference=array();  //Array containing the references
var $col=0;              //Current column number
var $NbCol;              //Total number of columns
var $y0;                 //Top ordinate of columns

function Header()
{
	if($this->RefActive)
	{
		//Title of index pages
		$this->SetFont('Arial','',15);
		$this->Cell(0,5,'Index',0,1,'C');
		$this->Ln();
	}
}

function Reference($txt)
{
	$Present=0;
	$size=sizeof($this->Reference);

	//Search the reference in the array
	for ($i=0;$i<$size;$i++){
		if ($this->Reference[$i]['t']==$txt){
			$Present=1;
			$this->Reference[$i]['p'].=','.$this->PageNo();
		}
	}

	//If not found, add it
	if ($Present==0)
	    $this->Reference[]=array('t'=>$txt,'p'=>$this->PageNo());
}

function CreateReference($NbCol)
{
	//Initialization
	$this->RefActive=true;
	$this->SetFontSize(8);

	//New page
	$this->AddPage();

	//Save the ordinate
	$this->y0=$this->GetY();
	$this->NbCol=$NbCol;
	$size=sizeof($this->Reference);
	$PageWidth=$this->w-$this->lMargin-$this->rMargin;

	for ($i=0;$i<$size;$i++){

		//Handles page break and new position
		if ($this->ChangePage) {
			$this->ChangePage=false;
			$this->y0=$this->GetY()-$this->FontSize-1;
		}

		//LibellLabel
		$str=$this->Reference[$i]['t'];
		$strsize=$this->GetStringWidth($str);
		$this->Cell($strsize+2,$this->FontSize+2,$str,0,0,'R');

		//Dots
		//Computes the widths
		$ColWidth = ($PageWidth/$NbCol)-2;
		$w=$ColWidth-$this->GetStringWidth($this->Reference[$i]['p'])-($strsize+4);
		if ($w<15)
			$w=15;
		$nb=$w/$this->GetStringWidth('.');
		$dots=str_repeat('.',$nb-2);
		$this->Cell($w-2,$this->FontSize+2,$dots,0,0,'L');

		//Page number
		$Largeur=$ColWidth-$strsize-$w;
		$this->Cell($Largeur,$this->FontSize+2,$this->Reference[$i]['p'],0,1,'R');
	}
	$this->RefActive=false;
}

function SetCol($col)
{
    //Set position on a column
    $this->col=$col;
    $x=$this->rMargin+$col*($this->w-$this->rMargin-$this->rMargin)/$this->NbCol;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function AcceptPageBreak()
{
	if ($this->RefActive) {
	    if($this->col<$this->NbCol-1)
	    {
        	//Go to the next column
        	$this->SetCol($this->col+1);
        	$this->SetY($this->y0);
        	//Stay on the page
        	return false;
    	}
    	else
    	{
    		//Go back to the first column
	        $this->SetCol(0);
        	$this->ChangePage=true;
        	//Page break
        	return true;
    	}
	}
	else
	{
		return true;
	}
}
}
?>

<?php
require('../../src/fpdf.php');

class PDF extends FPDF {

var $tablewidths;
var $footerset;

function _beginpage($orientation, $format) {
	$this->page++;
	if(!$this->pages[$this->page]) // solves the problem of overwriting a page if it already exists
		$this->pages[$this->page]='';
	$this->state=2;
	$this->x=$this->lMargin;
	$this->y=$this->tMargin;
	$this->FontFamily='';
	//Check page size
	if($orientation=='')
		$orientation=$this->DefOrientation;
	else
		$orientation=strtoupper($orientation[0]);
	if($format=='')
		$format=$this->DefPageFormat;
	else
	{
		if(is_string($format))
			$format=$this->_getpageformat($format);
	}
	if($orientation!=$this->CurOrientation || $format[0]!=$this->CurPageFormat[0] || $format[1]!=$this->CurPageFormat[1])
	{
		//New size
		if($orientation=='P')
		{
			$this->w=$format[0];
			$this->h=$format[1];
		}
		else
		{
			$this->w=$format[1];
			$this->h=$format[0];
		}
		$this->wPt=$this->w*$this->k;
		$this->hPt=$this->h*$this->k;
		$this->PageBreakTrigger=$this->h-$this->bMargin;
		$this->CurOrientation=$orientation;
		$this->CurPageFormat=$format;
	}
	if($orientation!=$this->DefOrientation || $format[0]!=$this->DefPageFormat[0] || $format[1]!=$this->DefPageFormat[1])
		$this->PageSizes[$this->page]=array($this->wPt, $this->hPt);
}

function Footer() {
	// Check if Footer for this page already exists (do the same for Header())
	if(!$this->footerset[$this->page]) {
		$this->SetY(-15);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		// set footerset
		$this->footerset[$this->page] = 1;
	}
}

function morepagestable($datas, $lineheight=8) {
	// some things to set and 'remember'
	$l = $this->lMargin;
	$startheight = $h = $this->GetY();
	$startpage = $currpage = $this->page;

	// calculate the whole width
	foreach($this->tablewidths AS $width) {
		$fullwidth += $width;
	}

	// Now let's start to write the table
	foreach($datas AS $row => $data) {
		$this->page = $currpage;
		// write the horizontal borders
		$this->Line($l,$h,$fullwidth+$l,$h);
		// write the content and remember the height of the highest col
		foreach($data AS $col => $txt) {
			$this->page = $currpage;
			$this->SetXY($l,$h);
			$this->MultiCell($this->tablewidths[$col],$lineheight,$txt);
			$l += $this->tablewidths[$col];

			if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
				$tmpheight[$row.'-'.$this->page] = $this->GetY();
			}
			if($this->page > $maxpage)
				$maxpage = $this->page;
		}

		// get the height we were in the last used page
		$h = $tmpheight[$row.'-'.$maxpage];
		// set the "pointer" to the left margin
		$l = $this->lMargin;
		// set the $currpage to the last page
		$currpage = $maxpage;
	}
	// draw the borders
	// we start adding a horizontal line on the last page
	$this->page = $maxpage;
	$this->Line($l,$h,$fullwidth+$l,$h);
	// now we start at the top of the document and walk down
	for($i = $startpage; $i <= $maxpage; $i++) {
		$this->page = $i;
		$l = $this->lMargin;
		$t  = ($i == $startpage) ? $startheight : $this->tMargin;
		$lh = ($i == $maxpage)   ? $h : $this->h-$this->bMargin;
		$this->Line($l,$t,$l,$lh);
		foreach($this->tablewidths AS $width) {
			$l += $width;
			$this->Line($l,$t,$l,$lh);
		}
	}
	// set it to the last page, if not it'll cause some problems
	$this->page = $maxpage;
}
}
?>

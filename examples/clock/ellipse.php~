<?php
require('fpdf.php');

class PDF_Ellipse extends FPDF
{
function Circle($x, $y, $r, $style='D')
{
	$this->Ellipse($x,$y,$r,$r,$style);
}

function Ellipse($x, $y, $rx, $ry, $style='D')
{
	if($style=='F')
		$op='f';
	elseif($style=='FD' || $style=='DF')
		$op='B';
	else
		$op='S';
	$lx=4/3*(M_SQRT2-1)*$rx;
	$ly=4/3*(M_SQRT2-1)*$ry;
	$k=$this->k;
	$h=$this->h;
	$this->_out(sprintf('%.2F %.2F m %.2F %.2F %.2F %.2F %.2F %.2F c',
		($x+$rx)*$k,($h-$y)*$k,
		($x+$rx)*$k,($h-($y-$ly))*$k,
		($x+$lx)*$k,($h-($y-$ry))*$k,
		$x*$k,($h-($y-$ry))*$k));
	$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
		($x-$lx)*$k,($h-($y-$ry))*$k,
		($x-$rx)*$k,($h-($y-$ly))*$k,
		($x-$rx)*$k,($h-$y)*$k));
	$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
		($x-$rx)*$k,($h-($y+$ly))*$k,
		($x-$lx)*$k,($h-($y+$ry))*$k,
		$x*$k,($h-($y+$ry))*$k));
	$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c %s',
		($x+$lx)*$k,($h-($y+$ry))*$k,
		($x+$rx)*$k,($h-($y+$ly))*$k,
		($x+$rx)*$k,($h-$y)*$k,
		$op));
}
}
?>

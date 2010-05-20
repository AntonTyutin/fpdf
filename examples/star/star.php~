<?php
require('fpdf.php');

class PDF_Star extends FPDF
{

function Star($x, $y, $rin, $rout, $points, $style='D')
{
	if($style=='F')
		$op = 'f';
	elseif($style=='FD' || $style=='DF')
		$op = 'B';
	else
		$op = 'S';
	$dth = M_PI/$points;
	$th = 0;
	$k = $this->k;
	$h = $this->h;
	$points_string = '';
	for($i=0;$i<($points*2)+1;$i++)
	{
		$th += $dth;
		$cx = $x + (($i%2==0 ? $rin : $rout) * cos($th));
		$cy = $y + (($i%2==0 ? $rin : $rout) * sin($th));
		$points_string .= sprintf('%.2F %.2F', $cx*$k, ($h-$cy)*$k);
		if($i==0)
			$points_string .= ' m ';
		else
			$points_string .= ' l ';
	}
	$this->_out($points_string . $op);
}

}
?>

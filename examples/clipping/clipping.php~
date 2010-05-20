<?php
require('fpdf.php');

class PDF_Clipping extends FPDF
{
	function ClippingText($x, $y, $txt, $outline=false)
	{
		$op=$outline ? 5 : 7;
		$this->_out(sprintf('q BT %.2F %.2F Td %d Tr (%s) Tj ET',
			$x*$this->k,
			($this->h-$y)*$this->k,
			$op,
			$this->_escape($txt)));
	}

	function ClippingRect($x, $y, $w, $h, $outline=false)
	{
		$op=$outline ? 'S' : 'n';
		$this->_out(sprintf('q %.2F %.2F %.2F %.2F re W %s',
			$x*$this->k,
			($this->h-$y)*$this->k,
			$w*$this->k,-$h*$this->k,
			$op));
	}

	function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
	{
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
			$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
	}

	function ClippingRoundedRect($x, $y, $w, $h, $r, $outline=false)
	{
		$k = $this->k;
		$hp = $this->h;
		$op=$outline ? 'S' : 'n';
		$MyArc = 4/3 * (sqrt(2) - 1);

		$this->_out(sprintf('q %.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
		$xc = $x+$w-$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

		$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
		$xc = $x+$w-$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
		$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
		$xc = $x+$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
		$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
		$xc = $x+$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
		$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
		$this->_out(' W '.$op);
	}

	function ClippingEllipse($x, $y, $rx, $ry, $outline=false)
	{
		$op=$outline ? 'S' : 'n';
		$lx=4/3*(M_SQRT2-1)*$rx;
		$ly=4/3*(M_SQRT2-1)*$ry;
		$k=$this->k;
		$h=$this->h;
		$this->_out(sprintf('q %.2F %.2F m %.2F %.2F %.2F %.2F %.2F %.2F c',
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
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c W %s',
			($x+$lx)*$k,($h-($y+$ry))*$k,
			($x+$rx)*$k,($h-($y+$ly))*$k,
			($x+$rx)*$k,($h-$y)*$k,
			$op));
	}

	function ClippingCircle($x, $y, $r, $outline=false)
	{
		$this->ClippingEllipse($x, $y, $r, $r, $outline);
	}

	function ClippingPolygon($points, $outline=false)
	{
		$op=$outline ? 'S' : 'n';
		$h = $this->h;
		$k = $this->k;
		$points_string = '';
		for($i=0; $i<count($points); $i+=2){
			$points_string .= sprintf('%.2F %.2F', $points[$i]*$k, ($h-$points[$i+1])*$k);
			if($i==0)
				$points_string .= ' m ';
			else
				$points_string .= ' l ';
		}
		$this->_out('q '.$points_string . 'h W '.$op);
	}

	function UnsetClipping()
	{
		$this->_out('Q');
	}

	function ClippedCell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	{
		if($border || $fill || $this->y+$h>$this->PageBreakTrigger)
		{
			$this->Cell($w,$h,'',$border,0,'',$fill);
			$this->x-=$w;
		}
		$this->ClippingRect($this->x,$this->y,$w,$h);
		$this->Cell($w,$h,$txt,'',$ln,$align,false,$link);
		$this->UnsetClipping();
	}
}
?>

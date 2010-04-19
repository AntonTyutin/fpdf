<?php
require('fpdf.php');

class PDF extends FPDF {

function MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $indent=0)
{
	//Output text with automatic or explicit line breaks
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;

	$wFirst = $w-$indent;
	$wOther = $w;

	$wmaxFirst=($wFirst-2*$this->cMargin)*1000/$this->FontSize;
	$wmaxOther=($wOther-2*$this->cMargin)*1000/$this->FontSize;

	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 && $s[$nb-1]=="\n")
		$nb--;
	$b=0;
	if($border)
	{
		if($border==1)
		{
			$border='LTRB';
			$b='LRT';
			$b2='LR';
		}
		else
		{
			$b2='';
			if(is_int(strpos($border,'L')))
				$b2.='L';
			if(is_int(strpos($border,'R')))
				$b2.='R';
			$b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
		}
	}
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$ns=0;
	$nl=1;
		$first=true;
	while($i<$nb)
	{
		//Get next character
		$c=$s[$i];
		if($c=="\n")
		{
			//Explicit line break
			if($this->ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border && $nl==2)
				$b=$b2;
			continue;
		}
		if($c==' ')
		{
			$sep=$i;
			$ls=$l;
			$ns++;
		}
		$l+=$cw[$c];

		if ($first)
		{
			$wmax = $wmaxFirst;
			$w = $wFirst;
		}
		else
		{
			$wmax = $wmaxOther;
			$w = $wOther;
		}

		if($l>$wmax)
		{
			//Automatic line break
			if($sep==-1)
			{
				if($i==$j)
					$i++;
				if($this->ws>0)
				{
					$this->ws=0;
					$this->_out('0 Tw');
				}
				$SaveX = $this->x; 
				if ($first && $indent>0)
				{
					$this->SetX($this->x + $indent);
					$first=false;
				}
				$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
					$this->SetX($SaveX);
			}
			else
			{
				if($align=='J')
				{
					$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
				}
				$SaveX = $this->x; 
				if ($first && $indent>0)
				{
					$this->SetX($this->x + $indent);
					$first=false;
				}
				$this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
					$this->SetX($SaveX);
				$i=$sep+1;
			}
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border && $nl==2)
				$b=$b2;
		}
		else
			$i++;
	}
	//Last chunk
	if($this->ws>0)
	{
		$this->ws=0;
		$this->_out('0 Tw');
	}
	if($border && is_int(strpos($border,'B')))
		$b.='B';
	$this->Cell($w,$h,substr($s,$j,$i),$b,2,$align,$fill);
	$this->x=$this->lMargin;
	}
}

?>

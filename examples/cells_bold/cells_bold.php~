<?php
require('fpdf.php');

class PDF extends FPDF
{

function WriteText($text)
{
	$intPosIni = 0;
	$intPosFim = 0;
	if (strpos($text,'<')!==false && strpos($text,'[')!==false)
	{
		if (strpos($text,'<')<strpos($text,'['))
		{
			$this->Write(5,substr($text,0,strpos($text,'<')));
			$intPosIni = strpos($text,'<');
			$intPosFim = strpos($text,'>');
			$this->SetFont('','B');
			$this->Write(5,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
			$this->SetFont('','');
			$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
		}
		else
		{
			$this->Write(5,substr($text,0,strpos($text,'[')));
			$intPosIni = strpos($text,'[');
			$intPosFim = strpos($text,']');
			$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
			$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'');
			$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
		}
	}
	else
	{
		if (strpos($text,'<')!==false)
		{
			$this->Write(5,substr($text,0,strpos($text,'<')));
			$intPosIni = strpos($text,'<');
			$intPosFim = strpos($text,'>');
			$this->SetFont('','B');
			$this->WriteText(substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
			$this->SetFont('','');
			$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
		}
		elseif (strpos($text,'[')!==false)
		{
			$this->Write(5,substr($text,0,strpos($text,'[')));
			$intPosIni = strpos($text,'[');
			$intPosFim = strpos($text,']');
			$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
			$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'');
			$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
		}
		else
		{
			$this->Write(5,$text);
		}

	}
}

}
?>

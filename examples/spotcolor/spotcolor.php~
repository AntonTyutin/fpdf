<?php
require('fpdf.php');

class PDF_SpotColor extends FPDF
{
var $SpotColors=array();

function AddSpotColor($name, $c, $m, $y, $k)
{
	if(!isset($this->SpotColors[$name]))
	{
		$i=count($this->SpotColors)+1;
		$this->SpotColors[$name]=array('i'=>$i,'c'=>$c,'m'=>$m,'y'=>$y,'k'=>$k);
	}
}

function SetDrawSpotColor($name, $tint=100)
{
	if(!isset($this->SpotColors[$name]))
		$this->Error('Undefined spot color: '.$name);
	$this->DrawColor=sprintf('/CS%d CS %.3F SCN',$this->SpotColors[$name]['i'],$tint/100);
	if($this->page>0)
		$this->_out($this->DrawColor);
}

function SetFillSpotColor($name, $tint=100)
{
	if(!isset($this->SpotColors[$name]))
		$this->Error('Undefined spot color: '.$name);
	$this->FillColor=sprintf('/CS%d cs %.3F scn',$this->SpotColors[$name]['i'],$tint/100);
	$this->ColorFlag=($this->FillColor!=$this->TextColor);
	if($this->page>0)
		$this->_out($this->FillColor);
}

function SetTextSpotColor($name, $tint=100)
{
	if(!isset($this->SpotColors[$name]))
		$this->Error('Undefined spot color: '.$name);
	$this->TextColor=sprintf('/CS%d cs %.3F scn',$this->SpotColors[$name]['i'],$tint/100);
	$this->ColorFlag=($this->FillColor!=$this->TextColor);
}

function _putspotcolors()
{
	foreach($this->SpotColors as $name=>$color)
	{
		$this->_newobj();
		$this->_out('[/Separation /'.str_replace(' ','#20',$name));
		$this->_out('/DeviceCMYK <<');
		$this->_out('/Range [0 1 0 1 0 1 0 1] /C0 [0 0 0 0] ');
		$this->_out(sprintf('/C1 [%.3F %.3F %.3F %.3F] ',$color['c']/100,$color['m']/100,$color['y']/100,$color['k']/100));
		$this->_out('/FunctionType 2 /Domain [0 1] /N 1>>]');
		$this->_out('endobj');
		$this->SpotColors[$name]['n']=$this->n;
	}
}

function _putresourcedict()
{
	parent::_putresourcedict();
	$this->_out('/ColorSpace <<');
	foreach($this->SpotColors as $color)
		$this->_out('/CS'.$color['i'].' '.$color['n'].' 0 R');
	$this->_out('>>');
}

function _putresources()
{
	$this->_putspotcolors();
	parent::_putresources();
}
}
?>

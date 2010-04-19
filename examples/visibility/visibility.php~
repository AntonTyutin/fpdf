<?php
require('fpdf.php');

class PDF_Visibility extends FPDF
{
var $visibility='all';
var $n_ocg_print;
var $n_ocg_view;

function SetVisibility($v)
{
	if($this->visibility!='all')
		$this->_out('EMC');
	if($v=='print')
		$this->_out('/OC /OC1 BDC');
	elseif($v=='screen')
		$this->_out('/OC /OC2 BDC');
	elseif($v!='all')
		$this->Error('Incorrect visibility: '.$v);
	$this->visibility=$v;
}

function _endpage()
{
	$this->SetVisibility('all');
	parent::_endpage();
}

function _enddoc()
{
	if($this->PDFVersion<'1.5')
		$this->PDFVersion='1.5';
	parent::_enddoc();
}

function _putocg()
{
	$this->_newobj();
	$this->n_ocg_print=$this->n;
	$this->_out('<</Type /OCG /Name '.$this->_textstring('print'));
	$this->_out('/Usage <</Print <</PrintState /ON>> /View <</ViewState /OFF>>>>>>');
	$this->_out('endobj');
	$this->_newobj();
	$this->n_ocg_view=$this->n;
	$this->_out('<</Type /OCG /Name '.$this->_textstring('view'));
	$this->_out('/Usage <</Print <</PrintState /OFF>> /View <</ViewState /ON>>>>>>');
	$this->_out('endobj');
}

function _putresources()
{
	$this->_putocg();
	parent::_putresources();
}

function _putresourcedict()
{
	parent::_putresourcedict();
	$this->_out('/Properties <</OC1 '.$this->n_ocg_print.' 0 R /OC2 '.$this->n_ocg_view.' 0 R>>');
}

function _putcatalog()
{
	parent::_putcatalog();
	$p=$this->n_ocg_print.' 0 R';
	$v=$this->n_ocg_view.' 0 R';
	$as="<</Event /Print /OCGs [$p $v] /Category [/Print]>> <</Event /View /OCGs [$p $v] /Category [/View]>>";
	$this->_out("/OCProperties <</OCGs [$p $v] /D <</ON [$p] /OFF [$v] /AS [$as]>>>>");
}
}
?>

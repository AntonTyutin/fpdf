<?php
require('morepagestable.php');

function GenerateWord()
{
	//Get a random word
	$nb=rand(3,10);
	$w='';
	for($i=1;$i<=$nb;$i++)
		$w.=chr(rand(ord('a'),ord('z')));
	return $w;
}

function GenerateSentence($words=500)
{
	//Get a random sentence
	$nb=rand(20,$words);
	$s='';
	for($i=1;$i<=$nb;$i++)
		$s.=GenerateWord().' ';
	return substr($s,0,-1);
}

$pdf = new PDF('P','pt');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,20,'Example to build Tables over more than one Page.');
// set the tablewidths like this or write an extra function
$pdf->tablewidths = array(90,90,90,90,90,90);

srand(microtime()*1000000);
for($i=0; $i < 4; $i++) {
	$datas[] = array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence());
}

$pdf->SetFont('Arial','',6);
$pdf->morepagestable($datas);
$pdf->Output();
?>

<?php
require('WriteTag.php');

$pdf=new PDF_WriteTag();
$pdf->SetMargins(30,15,25);
$pdf->SetFont('courier','',12);
$pdf->AddPage();

// Stylesheet
$pdf->SetStyle("p","courier","N",12,"10,100,250",15);
$pdf->SetStyle("h1","times","N",18,"102,0,102",0);
$pdf->SetStyle("a","times","BU",9,"0,0,255");
$pdf->SetStyle("pers","times","I",0,"255,0,0");
$pdf->SetStyle("place","arial","U",0,"153,0,0");
$pdf->SetStyle("vb","times","B",0,"102,153,153");

// Title
$txt="<h1>Le petit chaperon rouge</h1>";
$pdf->SetLineWidth(0.5);
$pdf->SetFillColor(255,255,204);
$pdf->SetDrawColor(102,0,102);
$pdf->WriteTag(0,10,$txt,1,"C",1,5);

$pdf->Ln(15);

// Text
$txt=" 
<p>Il <vb>était</vb> une fois <pers>une petite fille</pers> de <place>village</place>, 
la plus jolie qu'on <vb>eût su voir</vb>: <pers>sa mère</pers> en <vb>était</vb> 
folle, et <pers>sa mère grand</pers> plus folle encore. Cette <pers>bonne femme</pers> 
lui <vb>fit faire</vb> un petit chaperon rouge, qui lui <vb>seyait</vb> si bien 
que par tout on <vb>l'appelait</vb> <pers>le petit Chaperon rouge</pers>.</p> 

<p>Un jour <pers>sa mère</pers> <vb>ayant cuit</vb> et <vb>fait</vb> des galettes, 
<vb>lui dit</vb>: « <vb>Va voir</vb> comment <vb>se porte</vb> <pers>la mère-grand</pers>; 
car on <vb>m'a dit</vb> qu'elle <vb>était</vb> malade: <vb>porte-lui</vb> une 
galette et ce petit pot de beurre. »</p>
 
<p><pers>Le petit Chaperon rouge</pers> <vb>partit</vb> aussitôt pour <vb>aller</vb> 
chez <pers>sa mère-grand</pers>, qui <vb>demeurait</vb> dans <place>un autre village</place>. 
En passant dans <place>un bois</place>, elle <vb>rencontra</vb> compère <pers>le 
Loup</pers>, qui <vb>eut bien envie</vb> de <vb>la manger</vb>; mais il <vb>n'osa</vb> 
à cause de quelques <pers>bûcherons</pers> qui <vb>étaient</vb> dans 
<place>la forêt</place>.</p>
";

$pdf->SetLineWidth(0.1);
$pdf->SetFillColor(255,255,204);
$pdf->SetDrawColor(102,0,102);
$pdf->WriteTag(0,10,$txt,1,"J",0,7);

$pdf->Ln(5);

// Signature
$txt="<a href='http://www.pascal-morin.net'>Done by Pascal MORIN</a>";
$pdf->WriteTag(0,10,$txt,0,"R");

$pdf->Output();
?>

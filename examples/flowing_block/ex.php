<?php
require('flowing_block.php');

$pdf = new PDF_FlowingBlock();

$pdf->AddPage();
$pdf->newFlowingBlock( 40, 6, 'TBLR', 'J' );
$pdf->SetFont( 'Arial', 'B', 16 );
$pdf->WriteFlowingBlock( 'Hello ' );
$pdf->SetFont( 'Arial', 'I', 8 );
$pdf->WriteFlowingBlock( 'World! ' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( 'This is a test of the flowing block script.' );
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->WriteFlowingBlock( ' All' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( ' of this should be justified correctly.' . str_repeat( ' This is a test of the flowing block script.', 3 ) );
$pdf->finishFlowingBlock();

$pdf->AddPage();
$pdf->newFlowingBlock( 40, 6, 'TBLR', 'L' );
$pdf->SetFont( 'Arial', 'B', 16 );
$pdf->WriteFlowingBlock( 'Hello ' );
$pdf->SetFont( 'Arial', 'I', 8 );
$pdf->WriteFlowingBlock( 'World! ' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( 'This is a test of the flowing block script.' );
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->WriteFlowingBlock( ' All' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( ' of this should be justified correctly.' . str_repeat( ' This is a test of the flowing block script.', 3 ) );
$pdf->finishFlowingBlock();

$pdf->AddPage();
$pdf->newFlowingBlock( 40, 6, 'TBLR', 'R' );
$pdf->SetFont( 'Arial', 'B', 16 );
$pdf->WriteFlowingBlock( 'Hello ' );
$pdf->SetFont( 'Arial', 'I', 8 );
$pdf->WriteFlowingBlock( 'World! ' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( 'This is a test of the flowing block script.' );
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->WriteFlowingBlock( ' All' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( ' of this should be justified correctly.' . str_repeat( ' This is a test of the flowing block script.', 3 ) );
$pdf->finishFlowingBlock();

$pdf->AddPage();
$pdf->newFlowingBlock( 40, 6, 'TBLR', 'C' );
$pdf->SetFont( 'Arial', 'B', 16 );
$pdf->WriteFlowingBlock( 'Hello ' );
$pdf->SetFont( 'Arial', 'I', 8 );
$pdf->WriteFlowingBlock( 'World! ' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( 'This is a test of the flowing block script.' );
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->WriteFlowingBlock( ' All' );
$pdf->SetFont( 'Times', '', 10 );
$pdf->WriteFlowingBlock( ' of this should be justified correctly.' . str_repeat( ' This is a test of the flowing block script.', 3 ) );
$pdf->finishFlowingBlock();

$pdf->Output();
?>

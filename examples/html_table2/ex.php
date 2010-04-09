<?php
require('html_table.php');

$htmlTable='<TABLE>
<TR>
<TD>S. No.</TD>
<TD>Name</TD>
<TD>Age</TD>
<TD>Sex</TD>
<TD>Location</TD>
</TR>

<TR>
<TD>1</TD>
<TD>Azeem</TD>
<TD>24</TD>
<TD>Male</TD>
<TD>Pakistan</TD>
</TR>

<TR>
<TD>2</TD>
<TD>Atiq</TD>
<TD>24</TD>
<TD>Male</TD>
<TD>Pakistan</TD>
</TR>

<TR>
<TD>3</TD>
<TD>Shahid</TD>
<TD>24</TD>
<TD>Male</TD>
<TD>Pakistan</TD>
</TR>

<TR>
<TD>4</TD>
<TD>Roy Montgome</TD>
<TD>36</TD>
<TD>Male</TD>
<TD>USA</TD>
</TR>

<TR>
<TD>5</TD>
<TD>M.Bony</TD>
<TD>18</TD>
<TD>Female</TD>
<TD>&nbsp;</TD>
</TR>
</TABLE>';

$pdf=new PDF_HTML_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML("Start of the HTML table.<BR>$htmlTable<BR>End of the table.");
$pdf->Output();
?>

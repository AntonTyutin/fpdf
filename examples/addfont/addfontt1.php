<?php
/******************************************************************************/
/* Script to add TrueType or Type1 fonts to FPDF                              */
/*                                                                            */
/* author: Y. SUGERE                                                          */
/* version: 1.0                                                               */
/* date: 2003-04-28                                                           */
/* required files: addfont.php, addfontt1.php, addfontttf.php                 */
/* other necessary software: pfm2afm, ttf2pt1, fpdf                           */
/* For more information, see readme.txt                                       */
/*                                                                            */
/* This file processes Type1 fonts                                            */
/******************************************************************************/

require('makefont.php');

function EncodingList()
{
	// list all available encodings
	$d=dir('.');
	while($f=$d->read())
	{
		if(preg_match('/([a-z0-9_-]+)\\.map$/i',$f,$res))
			$enc[]=$res[1];
	}
	$d->close();
	sort($enc);
	echo '<select name="enc">';
	foreach($enc as $e)
		printf('<option %s>%s</option>',$e=='cp1252' ? 'selected' : '',$e);
	echo "</select>\n";
}

if(isset($_FILES['pfb'])){
	// get font file
	$tmp=$_FILES['pfb']['tmp_name'];
	$pfb=$_FILES['pfb']['name'];
	$a=explode('.',$pfb);
	if(strtolower($a[1])!='pfb')
		die('File is not a .pfb');
	if($_FILES['pfb']['error']!=UPLOAD_ERR_OK)
		die('Upload failed (error code: '.$_FILES['pfb']['error'].')');
	if(!move_uploaded_file($tmp,$pfb))
		die('move_uploaded_file() failed');
	$fontname=$_POST['fontname'];
	if(empty($fontname))
		$fontname=$a[0];
	// get font metric file
	$tmp=$_FILES['fm']['tmp_name'];
	$fm=$_FILES['fm']['name'];
	$a=explode('.',$fm);
	$fm_type=strtolower($a[1]);
	if($fm_type!='pfm' && $fm_type!='afm')
		die('File is not .pfm nor .afm');
	$fm="$fontname.$fm_type";
	if($_FILES['fm']['error']!=UPLOAD_ERR_OK)
		die('Upload failed (error code: '.$_FILES['fm']['error'].')');
	if(!move_uploaded_file($tmp,$fm))
		die('move_uploaded_file() failed');
	if($fm_type=='pfm')
	{
		// PFM->AFM conversion
		system("pfm2afm.exe -a $fm $fontname.afm");
		unlink($fm);
		$fm="$fontname.afm";
	}
	// MakeFont call
	MakeFont($pfb,$fm,$_POST['enc']);
	copy("$fontname.php","../$fontname.php");
	unlink("$fontname.php");
	if(file_exists("$fontname.z"))
	{
		copy("$fontname.z","../$fontname.z");
		unlink("$fontname.z");
	}
	else
		copy($pfb,"../$pfb");
	unlink($fm);
	unlink($pfb);
	echo "<script language='javascript'>alert('Font processed');\n";
	echo "window.location.href='addfont.php';</script>";
}
?>
<!doctype html public "-//W3C//DTD HTML 4.0//EN">
<html>
<head>
	<title>Font upload</title>
</head>
<body>
<form action="addfontt1.php" method="post" enctype="multipart/form-data">
<table border="0" cellspacing="5" cellpadding="5" width="300">
	<tr>
		<th align="left" colspan="2">
			Choose the .pfb file:
		</th>
	</tr>
	<tr>
		<td align="left" colspan="2">
			<input type="file" name="pfb">
		</td>
	</tr>
	<tr>
		<th align="left" colspan="2">
			Choose the .pfm or .afm file:
		</th>
	</tr>
	<tr>
		<td align="left" colspan="2">
			<input type="file" name="fm">
		</td>
	</tr>
	<tr>
		<td align="left">
			Font name:
		</td>
		<td align="left">
			<input type="text" name="fontname">
		</td>
	</tr>
	<tr>
		<td align="left">
			Font encoding:
		</td>
		<td align="left">
			<?php EncodingList(); ?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input type="reset" name="btnSub" value="Clear">
		</td>
		<td align="center">
			<input type="submit" name="btnSub" value="Send">
		</td>
	</tr>
</table>
</form>
</body>
</html>

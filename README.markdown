Unofficial repository for the FPDF library
==

This is an unofficial repository for the [FPDF-library](http://fpdf.org). The purpose is to be able to build automatic pear packages using [pearhub](http://pearhub.org). [Support](http://fpdf.org/phorum/) is found at the [FPDF-library](http://fpdf.org) page.

Installation
--

    pear channel-discover pearhub.org
    pear install pearhub.org/fpdf   

Information about installation
--

The FPDF library is made up of the following elements:

- the main file, fpdf.php, which contains the class
- the font metric files (located in the font directory of this archive)

The metric files are necessary as soon as you want to output some text in a document.
They can be accessed from three different locations:

- the directory defined by the FPDF_FONTPATH constant (if this constant is defined)
- the font directory located in the directory containing fpdf.php (as it is the case in this archive)
- the directories accessible through include()

Here is an example defining FPDF_FONTPATH (note the mandatory final slash):

define('FPDF_FONTPATH','/home/www/font/');
require('fpdf.php');

If the files are not accessible, the SetFont() method will produce the following error:

FPDF error: Could not include font metric file

Remarks:

- Only the files corresponding to the fonts actually used are necessary
- The tutorials provided in this package are ready to be executed

Todo
--

* Fix the coding standards to PHP_Codesniffer standards 
    
Other options
--

- It seems someone started creating a [PHP 5 version of FPDF](http://code.google.com/p/fpdf-5/). However, it seems to be abandoned already. Might be worthwhile to import it and finish up the work.
- Might also be worthwhile checking out [R&S Pdf class](https://pdf-php.svn.sourceforge.net/svnroot/pdf-php).
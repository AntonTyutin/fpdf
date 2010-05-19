Unofficial repository for the FPDF library
==

This is an unofficial repository for the [FPDF-library](http://fpdf.org). The purpose is to be able to build automatic pear packages using [pearhub](http://pearhub.org). [Support](http://fpdf.org/phorum/) is found at the [FPDF-library](http://fpdf.org) page.

What is FPDF?
--

FPDF is a PHP class which allows to generate PDF files with pure PHP, that is to say without using the PDFlib library. F from FPDF stands for Free: you may use it for any kind of usage and modify it to suit your needs.

FPDF has other advantages: high level functions. Here is a list of its main features:

* Choice of measure unit, page format and margins
* Page header and footer management
* Automatic page break
* Automatic line break and text justification
* Image support (JPEG, PNG and GIF)
* Colors
* Links
* TrueType, Type1 and encoding support
* Page compression

FPDF requires no extension (except zlib to activate compression and GD for GIF support). It works with PHP 4 and PHP 5 (the latest version requires at least PHP 4.3.10).

The tutorials will give you a quick start. The complete online documentation is here and download area is there. It is strongly advised to read the FAQ which lists the most common questions and issues.

A script section is available and provides some useful extensions (such as bookmarks, rotations, tables, barcodes...).

What languages can I use?
--

The class can produce documents in many languages other than the Western European ones: Central European, Cyrillic, Greek, Baltic and Thai, provided you own TrueType or Type1 fonts with the desired character set. Chinese, Japanese and Korean are supported too. UTF-8 support is also available.

What about performance?
--

Of course, the generation speed of the document is less than with PDFlib. However, the performance penalty keeps very reasonable and suits in most cases, unless your documents are particularly complex or heavy.

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
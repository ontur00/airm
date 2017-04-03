<?php
/**
* script by Przemyslaw Cios version 1.0 beta 1 
 */
$kod = $_GET['kod'];

// Including all required classes
require('genbr/BCGFont.php');
require('genbr/BCGColor.php');
require('genbr/BCGDrawing.php'); 

// Including the barcode technology
include('genbr/BCGcode93.barcode.php'); 

// Loading Font
$font = new BCGFont('./genbr/font/Arial.ttf', 18);

// The arguments are R, G, B for color.
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255); 

$code = new BCGcode93();
$code->setScale(2); // Resolution
$code->setThickness(30); // Thickness
$code->setForegroundColor($color_black); // Color of bars
$code->setBackgroundColor($color_white); // Color of spaces
$code->setFont($font); // Font (or 0)
$code->parse($kod); // Text


/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);
$drawing->draw();

// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>

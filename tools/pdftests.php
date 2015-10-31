<?php defined('C5_EXECUTE') or die(_("Access denied."));
header('Content-type:text/plain');

$pkg = Package::getByHandle('pdfthumbs');

if(!$mudraw = trim(shell_exec("which mudraw 2>&1"))) {
  echo "Foo!";
} else {
  var_dump($mudraw);
}

exit();

$mu_path = `which mudraw`;
if($mu_path) {
	echo "MuPDF was found" . PHP_EOL;
	Config::save('PDFT_MUPDFPATH', trim($mu_path));
}

$gs_path = `which gs`;
if($gs_path) {
	echo "Ghostscript was found" . PHP_EOL;
	Config::save('PDFT_GSPATH', trim($gs_path));
}

$im_path = `which convert`;
if($im_path) {
	echo "ImageMagick was found" . PHP_EOL;
	Config::save('PDFT_IMPATH', trim($im_path));
}

if(class_exists('imagick')) {
	echo "ImageMagick PHP extension was found" . PHP_EOL;
	if(in_array('PDF', Imagick::queryFormats('PDF'))) {
		echo "Imagick supports PDF!" . PHP_EOL;
	}


} else {
	echo "Imagick PHP extension was not found" . PHP_EOL;
}

var_dump( Config::get('PDFT_MUPDFPATH') );
var_dump( Config::get('PDFT_GSPATH') );
var_dump( Config::get('PDFT_IMPATH') );

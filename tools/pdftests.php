<?php defined('C5_EXECUTE') or die(_("Access denied."));
//header('Content-type:text/plain');
header('Content-type:application/json;charset=utf-8');
//this file may be deprecated

$json = Loader::helper('json');
$pkg = Package::getByHandle('pdfthumbs');


echo $json->encode( array('status'=>'OK', 'message'=>t('Hello, it is me.')) );
/*

@exec("which mudraw", $mu_path);
if($mu_path) {
	echo "MuPDF was found" . PHP_EOL;
	$pkg->saveConfig('PDFT_MUPDFPATH', trim($mu_path));
} else {
	echo "MuPDF was not found" . PHP_EOL;
	$pkg->saveConfig('PDFT_MUPDFPATH', false);
}


@exec("which gs", $gs_path);
if($gs_path) {
	echo "Ghostscript was found" . PHP_EOL;
	$pkg->saveConfig('PDFT_GSPATH', trim($gs_path[0]));
} else {
	echo "Ghostscript was not found" . PHP_EOL;
	$pkg->saveConfig('PDFT_GSPATH', false);
}

//$im_path = `which convert 2>&1`;
@exec("which convert", $im_path);
if($im_path) {
	echo "ImageMagick was found" . PHP_EOL;
	$pkg->saveConfig('PDFT_IMPATH', trim($im_path[0]));
} else {
	echo "ImageMagick was not found" . PHP_EOL;
	$pkg->saveConfig('PDFT_IMPATH', false);	
}

if( (class_exists('imagick')) &&  (in_array('PDF', Imagick::queryFormats('PDF')) )) {
	echo "ImageMagick PHP extension was found and supports PDF."  . PHP_EOL;
	$pkg->saveConfig('PDFT_NATIVE_SUPPORT', true);
} else {
	echo "Imagick PHP extension was not found or doesn't support PDF." . PHP_EOL;
	$pkg->saveConfig('PDFT_NATIVE_SUPPORT', false);
}

var_dump( $pkg->config('PDFT_NATIVE_SUPPORT') );
var_dump( $pkg->config('PDFT_MUPDFPATH') );
var_dump( $pkg->config('PDFT_GSPATH') );
var_dump( $pkg->config('PDFT_IMPATH') );
*/
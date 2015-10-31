<?php defined('C5_EXECUTE') or die(_("Access denied."));
header('Content-type:application/json;charset=utf-8');

//Check permissions

$fID = isset($_GET['fID'])?(int)$_GET['fID']:0;
$file = File::getByID($fID);


$fp = new Permissions($file);
if ($fp->canEditFileContents()) { 
	$fv = $file->getApprovedVersion();

	if($fv->getMimeType() == 'application/pdf') {
		Loader::helper('pdfthumb', 'pdfthumbs')->generate();	
	}
}


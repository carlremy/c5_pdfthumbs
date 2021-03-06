<?php defined('C5_EXECUTE') or die(_("Access denied."));
header('Content-type:application/json;charset=utf-8');

$fID = isset($_GET['fID'])?(int)$_GET['fID']:0;
$file = File::getByID($fID);


//Check permissions
$fp = new Permissions($file);
if ($fp->canEditFileContents()) { 
	$fv = $file->getApprovedVersion();
	$ajax = Loader::helper('ajax');

	if($fv->getMimeType() == 'application/pdf') {
		if($success = Loader::helper('pdfthumb', 'pdfthumbs')->generate($fv) ) {
			$ajax->sendResult( array('status'=>'OK', 'src'=>$fv->getThumbnailSRC(1)) );	
		} else {
			$ajax->sendError( t('Unable to generate PDF Preview.') );	
		}
	}
}


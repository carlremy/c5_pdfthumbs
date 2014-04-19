<?php defined('C5_EXECUTE') or die(_("Access denied."));

class PDFThumbsPackage extends Package {


    /*  CONFIG AREA */

    protected $pkgHandle = 'c5_pdfthumbs'; //Setting this value in "public function getPackageHandle(){}" has some issues in Concrete 5.6.1
    protected $appVersionRequired = '5.6.1';
    protected $pkgVersion = '0.1';

	public function getPackageName() {
		return t('PDF Thumbnail Creator');
	}

	public function getPackageDescription() {
		return t('Creates thumbnails for PDF files. Requires MuPDF (preferred) or ImageMagick with Ghostscript.');
	}

	public function install() {
	  if($this->checkRequirements()) {
  	  $pkg = parent::install();
	  }

	}

	protected function checkRequirements() {
    //safe mode off

    //MuPDF install and in path

    /* OR */

    //Imagick installed

    /* OR */

    //ImageMagick and Ghostscript installed

    //FAIL

	}
}

<?php defined('C5_EXECUTE') or die(_("Access denied."));

class PdfThumbsPackage extends Package {


  /*  CONFIG AREA */

  protected $pkgHandle = 'pdfthumbs'; //Setting this value in "public function getPackageHandle(){}" has some issues in Concrete 5.6.1
  protected $appVersionRequired = '5.6.1';
  protected $pkgVersion = '0.3';

  public function getPackageName() {
    return t('PDF Thumbnail Creator');
  }

  public function getPackageDescription() {
    return t('Creates thumbnails for PDF files. Requires MuPDF (preferred) or ImageMagick with Ghostscript.');
  }

  public function install() {
    
    if(!$this->checkRequirements()) {

      throw new Exception(t('Installation cannot be completed. Some requirements were not met: %s'), implode("\n", $this->installation_errors));
    }
    
    $pkg = parent::install();
    $this->addSinglePages($pkg);

  }

  public function uninstall() {
    parent::uninstall();
  }

  public function on_start() {
    //Events::extend($event, $class, $method, $filename, $params = array(), $priority = 5);
    //Events::extend('on_file_add', __CLASS__,'on_file_add',__FILE__);
    Events::extend('on_file_version_add', __CLASS__,'on_file_version_add',__FILE__);
  }

  protected function checkRequirements() {

    //http://www.concrete5.org/documentation/how-tos/developers/check-prerequisites-before-installing-a-package/
    $warnings = array();
    $errors = array();

    if(!function_exists('shell_exec')) {
      $errors[] = t('Function shell_exec is required but not available.');
    }

    if(!$mupdf = shell_exec("which mudraw 2>&1")) {
      $warnings[] = t('MuPDF was not found in your path.');
    }

    if(!$gs = shell_exec("which gs 2>&1")) {
      $warnings[] = t('Ghostscript was not found in your path.');
    }

    if(!$convert = shell_exec("which convert 2>&1")) {
      $warnings[] = t('Imagemagick was not found in your path.');
    }

    if(!$imagick = class_exists("imagick")) {
      $warnings[] = t('PHP Imagick class is not installed.');
    }

    if(count($warnings) > 0) {
      $this->installation_errors = $warnings;
      return false;
    } 

    if(count($errors) > 0) {
      $this->installation_errors += $errors;
      return false;
    }

    return true;
  }

  public function upgrade(){
    $pkg = Package::getByHandle('pdfthumbs');
    BlockType::installBlockTypeFromPackage('pdf_thumb', $pkg);
  }

  protected function addSinglePages($pkg) {
    Loader::model('single_page');
    $pg = SinglePage::add('dashboard/system/pdf_thumbnails', $pkg);
    if (is_object($pg)) {
      $pg->update(array('cName'=>t("PDF Thumbs Settings"), 'cDescription'=>''));
    }

    $pg = SinglePage::add('dashboard/system/reports/pdf_thumbs', $pkg);
    if (is_object($pg)) {
      $pg->update(array('cName'=>t("PDF Thumbs Requirements"), 'cDescription'=>''));
    }
  }

  public function on_file_add($file){
    //Log::addEntry(print_r(func_get_args(),1), 'FooTest-on_file_add');
  }

  public function on_file_version_add($version){
    Log::addEntry(print_r($version->getMimetype(),1), 'FooTest-on_file_version_add');

    if($version->getMimetype() != 'application/pdf') return;
    $fh = Loader::helper('file');
    $ih = Loader::helper('image');

    $pdf = Loader::helper('pdfthumb', 'pdfthumbs');

    $pdf->generate($version);

  }  
}

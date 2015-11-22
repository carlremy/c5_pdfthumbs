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
    $config = $this->checkRequirements();
    if(!$config) {
      throw new Exception(t('Installation cannot be completed. Some requirements were not met: %s', implode("\n", $this->installation_errors)));
    }
    
    $pkg = parent::install();
    $this->addSinglePages($pkg);

    foreach($config as $k=>$v){
      $pkg->saveConfig($k, $v);
    }

    BlockType::installBlockTypeFromPackage('pdf_thumb', $pkg);

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
    $config = array();

    //Must be able to run shell commands
    if(!function_exists('exec')) {
      $errors[] = t('Function shell_exec is required but not available.');
    }

    //See if mupdf is installed
    @exec("which mudraw", $mu_path);
    if($mu_path) {
     $config['PDFT_MUPDFPATH'] = trim($mu_path);
    } else {
      $warnings[] = t('MuPDF was not found');
      $config['PDFT_MUPDFPATH'] = false;
    }

    //See if ghostscript is installed
    @exec("which gs", $gs_path);
    if($gs_path) {
      $config['PDFT_GSPATH'] = trim($gs_path[0]);

      //if ghostscript, make sure IM is installed
      @exec("which convert", $im_path);
      if($im_path) {
        $config['PDFT_IMPATH'] = trim($im_path[0]);
      } else {
        $warnings[] = t('ImageMagick was not found');
        $config['PDFT_IMPATH'] = false; 
      }

    } else {
      $warnings[] = t('Ghostscript was not found');
      $config['PDFT_GSPATH'] = false;
      $config['PDFT_IMPATH'] = false;
    }

    //See if PHP imagick ext is installed and that it supports PDF
    if( (class_exists('imagick')) &&  (in_array('PDF', Imagick::queryFormats('PDF')) )) {
      $config['PDFT_NATIVE_SUPPORT'] = true;
    } else {
      $warnings[] =  t("Imagick PHP extension was not found or doesn't support PDF.");
      $config['PDFT_NATIVE_SUPPORT'] = false;
    }

    if(count($warnings) > 4) {
      $this->installation_errors = $warnings;
      return false;
    } 

    if(count($errors) > 0) {
      $this->installation_errors += $errors;
      return false;
    }

    return $config;
  }

  public function upgrade(){

  }

  protected function addSinglePages($pkg) {
    Loader::model('single_page');
    $pg = SinglePage::add('dashboard/system/pdf_thumbs/settings', $pkg);
    if (is_object($pg)) {
      $pg->update(array('cName'=>t("PDF Thumbs Settings"), 'cDescription'=>''));
    }

    $pg = SinglePage::add('dashboard/system/pdf_thumbs/reports', $pkg);
    if (is_object($pg)) {
      $pg->update(array('cName'=>t("PDF Thumbs Requirements"), 'cDescription'=>''));
    }
  }

  public function on_file_version_add($version){

    if($version->getMimetype() != 'application/pdf') return;

    $fh = Loader::helper('file');
    $ih = Loader::helper('image');

    $pdf = Loader::helper('pdfthumb', 'pdfthumbs');

    $pdf->generate($version);

  }  
}

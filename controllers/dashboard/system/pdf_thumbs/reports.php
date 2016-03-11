<?php   defined('C5_EXECUTE') or die("Access Denied.");

class DashboardSystemPdfThumbsReportsController extends DashboardBaseController {

  public function view() {
    //$this->set('Bababooey', 'Gary Dell\'abate');
  }

  public function on_start(){
  	$pkg = Package::getByHandle('pdfthumbs');
  	$this->pkg = $pkg;
  	$this->set('pkg', $pkg);
    $this->set('pdfconfig', Config::getListByPackage($pkg));
  }

  public function save(){

    if($this->post('PDFT_MUPDFPATH')) {
      $this->pkg->saveConfig('PDFT_MUPDFPATH', $this->post('PDFT_MUPDFPATH'));
      $this->set('message', t('Settings saved.'));
    }
    //var_dump( $this->pkg );

    $this->view();
    //exit;
  }
}
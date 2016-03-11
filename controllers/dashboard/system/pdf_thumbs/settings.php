<?php   defined('C5_EXECUTE') or die("Access Denied.");

class DashboardSystemPdfThumbsSettingsController extends DashboardBaseController {

  public function view() {
  	$pkg = Package::getByHandle('pdfthumbs');
  	$pkgconfig = Config::getListByPackage($pkg);
		//${$co->key} = $co->value;
  	foreach($pkgconfig as $co) {
  		$this->set($co->key, $co->value);
  	}

  	$this->set('pkg', $pkg);
    $this->set('pdfconfig', $pkgconfig);
  }

  public function save_settings() {
  	if($this->isPost()) {
  		
  	}
  }
}
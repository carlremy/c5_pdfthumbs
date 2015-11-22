<?php   defined('C5_EXECUTE') or die("Access Denied.");

class DashboardSystemPdfThumbsReportsController extends DashboardBaseController {

  public function view() {
  	$pkg = Package::getByHandle('pdfthumbs');
  	$this->set('pkg', $pkg);
    $this->set('pdfconfig', Config::getListByPackage($pkg));

  }

}
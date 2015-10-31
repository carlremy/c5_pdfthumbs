<?php   defined('C5_EXECUTE') or die("Access Denied.");

class DashboardSystemReportsPdfThumbsController extends DashboardBaseController {

  public function view() {
  	
    $this->set('Foo', 'Bar');

    $this->set('requirements', $this->_check_requirements());
    $this->set('env', $GLOBALS);
  }

  private function _check_requirements() {
  	$shell = $_ENV['SHELL'];

    $which = shell_exec('which');
    //if()
    return array(
      'CAN_EXEC' => function_exists('shell_exec'),
  		'MUPDF' 	=> false,
  		'IM_EXT' 	=> true,
  		'PDFTYPE' => true,
  	);
  }
}
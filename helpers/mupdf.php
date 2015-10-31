<?php

class MuPDF_helper {
  
  if(!function_exists('exec')) {
  	throw new Exception(t('You server does not support the `exec` function. You should enable exec or use the Imagick extension instead.');
  }

  public $cmd;// = Config::get('MUPDF_PATH');

  public function __construct(){
  	$this->cmd = Config::get('MUPDF_PATH');

  }

  public function setOutput() {

  }

  private function run(){
  	
  }

}
<?php defined('C5_EXECUTE') or die("Access Denied.");

class PDFThumbBlockController extends BlockController {

	protected $btInterfaceWidth = 450;
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = true;
	protected $btInterfaceHeight = 250;
	protected $btTable = 'btPDFThumb';
    protected $btWrapperClass = 'ccm-ui';
	protected $btExportFileColumns = array('fID');

	/** 
	 * Used for localization. If we want to localize the name/description we have to include this
	 */
	public function getBlockTypeDescription() {
		return t("Link to document files stored in the asset library and display them with an image file.");
	}

	public function getBlockTypeName() {
		return t("PDF Thumb");
	}

	public function getJavaScriptStrings() {
		return array('file-required' => t('You must select a file.'));	
	}

	public function on_before_render(){
		//$this->addHeaderItem( Loader::helper('html')->css('https://cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.min.css') );			
	}



	public function on_page_view(){
		$this->addHeaderItem( Loader::helper('html')->css('https://cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.min.css') );
		$this->addFooterItem( Loader::helper('html')->javascript('https://cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.min.js') );	
	}

	public function view(){
		$this->addHeaderItem( Loader::helper('html')->css('https://cdn.jsdelivr.net/fancybox/2.1.5/jquery.fancybox.min.css') );	
		$f = File::getByID($this->fID);
		$fv = $f->getRecentVersion();
		$this->set('fv', $fv);

		$ts = (int)$this->thumbnailSize;
		if($fv->hasThumbnail($ts)) {
			$this->set('thumbnail', $fv->getThumbnail($ts));
		}
	}
 
	public function validate($args) {
		$e = Loader::helper('validation/error');
		if ($args['fID'] < 1) {
			$e->add(t('You must select a file.'));
		}
		

		return $e;
	}

	function getFileID() {return $this->fID;}

	function getFileObject() {
		return File::getByID($this->fID);
	}

}

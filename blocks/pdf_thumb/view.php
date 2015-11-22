<?php defined('C5_EXECUTE') or die(_('Access denied.'));
	$f = $controller->getFileObject();
	$fp = new Permissions($f);
	if ($fp->canViewFile()) { 
		$c = Page::getCurrentPage();
		if($c instanceof Page) {
			$cID = $c->getCollectionID();
		}
?>
<div class="pdfthumb-container" id="pdf-thumb-block-<?php echo $bID?>">
	<a href="<?php echo $fv->getThumbnailSRC(3)?>" 
		rel="pdfthumb-lightbox" 
		id="file-fid-<?php echo $f->fID?>-bid-<?php echo $bID?>" 
		title="<?php echo h($fv->getTitle()) ?>" 
		data-fid="<?php echo $f->fID ?>"
		data-cid="<?php echo $cID ?>"
		class="pdfthumb-link"><?php echo $thumbnail ?></a>
	<p class="pdfthumb-caption">
		<?php echo $fv->getTitle()?>
	</p>
	<?php if($description = $fv->getDescription()): ?>
		<p class="pdfthumb-description"><?php echo $description ?></p>
	<?php endif ?>
	<p class="pdf-thumb-metadata">
		<a class="pdf-thumb-download-link" href="<?php echo  $fv->getForceDownloadURL() ?>"><?php echo t("Download")?></a><span class="size">(<?php echo Loader::helper('number')->formatSize($fv->getSize())?>)</span> | <span class="type"><?php echo $fv->getType() ?></span>
	</p>
</div>
<?php }
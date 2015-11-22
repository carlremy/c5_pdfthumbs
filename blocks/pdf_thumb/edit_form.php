<?php defined('C5_EXECUTE') or die(_('Access Denied.'));
$al = Loader::helper('concrete/asset_library');
$fh= Loader::helper('form');

?>
<!--div class="ccm-block-field-group"-->
	
	<h4><?php echo t('File to Display')?></h4><br>

	<div class="clearfix">
		<?php echo $fh->label('ccm-b-file', t('File')) ?>
		<div class="input">	
			<?php echo $al->doc('ccm-b-file', 'fID', t('Choose File'), $fID);?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $fh->label('ccm-b-image', t('Alternate Image')) ?>
		<div class="input">	
			<?php echo $al->image('ccm-b-image', 'altThumbnailfID', t('Choose Image'), $altThumbnailfID);?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $fh->label('thumbnailSize', t('Thumbnail Size')) ?>
		<div class="input">	
			<?php echo $fh->select('thumbnailSize', array(1=>t('Small'), 2=>t('Medium'), 3=>t('Large')), $thumbnailSize) ?>
		</div>
	</div>
	
	<div class="clearfix">
		<?php echo $fh->label('','&nbsp;')?>
		<div class="input">	
			<a href="#" id="btn-refresh-thumbnail" class="btn btn-default">Refresh Thumbnail</a>
		</div>
	</div>
<!--/div-->


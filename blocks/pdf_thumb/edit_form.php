<?php defined('C5_EXECUTE') or die(_('Access Denied.'));
$al = Loader::helper('concrete/asset_library');
$fh= Loader::helper('form');

?>
<div class="ccm-block-field-group">

<div class="row">
	<div class="span6">
		<?php echo $al->doc('ccm-b-file', 'fID', t('Choose File'), $fID);?>
	</div>
</div>

<hr>
<div class="row">
	<div class="span4">
		<?php echo $fh->label('ccm-b-file', t('Thumbnail Size')) ?>
		<div class="input">
			<?php echo $fh->select('thumbnailSize', array(1=>t('Small'), 2=>t('Medium'), 3=>t('Large')), $thumbnailSize, array('class'=>'form-control')) ?>
		</div>
	</div>
</div>
</div>
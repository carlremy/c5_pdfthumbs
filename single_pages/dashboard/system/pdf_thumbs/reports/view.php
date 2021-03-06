<?php   defined('C5_EXECUTE') or die('Access Denied.');

$dh = Loader::helper('concrete/dashboard');
$th = Loader::helper('text');
$jh = Loader::helper('json');
$fh = Loader::helper('form');

echo $dh->getDashboardPaneHeaderWrapper(t('PDF Thumbs Settings'), t('Choose your preferred PDF Generation here.'), ('span8 offset2'), false); ?>
<form class="form-horizontal" method="post" action="<?php echo $this->action('save')?>">
  <div class="ccm-pane-body">
    <p><?php echo t('The available PDF generation methods are listed below. The default method used is the first available. If you want to override this value, you may do so as well.') ?></p>
    <!--pre-->
  <?php

  foreach( $pdfconfig as $co) {
    ${$co->key} = $co->value;
  }
         ?>

      <!--/pre-->
    <div class="clearfix">
      <dl class="dl-horizontal">
        <dt>MuPDF</dt>
        <dd><?php if($PDFT_MUPDFPATH): ?><span class="badge badge-success"><i class="icon-ok-sign icon-white"></i> </span><?php else: ?><span class="badge badge-warning"><i class="icon-exclamation-sign icon-white"></i></span><?php endif?> &nbsp;</dd>
        <dt>ImageMagick</dt>
        <dd><?php if($PDFT_IMPATH): ?><span class="badge badge-success"><i class="icon-ok-sign icon-white"></i> </span><?php else: ?><span class="badge badge-warning"><i class="icon-exclamation-sign icon-white"></i></span> <?php endif?> &nbsp;</dd>
        <dt><?php echo t('Native')?> IMagick</dt>
        <dd><?php if($PDFT_NATIVE_SUPPORT): ?><span class="badge badge-success"><i class="icon-ok-sign icon-white"></i> </span><?php else: ?><span class="badge badge-warning"><i class="icon-exclamation-sign icon-white"></i></span><?php endif?> &nbsp;</dd>
      </dl>
      <div class="control-group">
        <?php echo $fh->label('PDFT_MUPDFPATH', t('MuPDF Path'), array('class'=>'control-label'));?>
        <div class="controls">
          <?php echo $fh->text('PDFT_MUPDFPATH', $PDFT_MUPDFPATH, array('class'=>'form-control'))?>
        </div>
      </div>
      <div class="control-group">
        <?php echo $fh->label('PDFT_IMPATH', t('ImageMagick Path'), array('class'=>'control-label'));?>
        <div class="controls">
          <?php echo $fh->text('PDFT_IMPATH', $PDFT_IMPATH, array('class'=>'form-control'))?>
        </div>
      </div>
    </div>
  </div>
  <div class="ccm-pane-footer">
    <div style="float:right" id="pdf-thumbs-requirements-container">
      <?php echo $form->submit('submit', t('Save Settings'), array('class' => 'ccm-button-right primary')) ?>
    </div>
  </div>
</form>
<?php
echo $dh->getDashboardPaneFooterWrapper();
// /tools/packages/pdfthumbs/pdftests

/*

PDFT_GSPATH /usr/bin/gs
PDFT_IMPATH /usr/bin/convert
PDFT_MUPDFPATH 0
PDFT_NATIVE_SUPPORT 1


*/
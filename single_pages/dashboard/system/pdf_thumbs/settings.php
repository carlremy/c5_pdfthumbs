<?php   defined('C5_EXECUTE') or die('Access Denied.');

$dh = Loader::helper('concrete/dashboard');
$th = Loader::helper('text');
$jh = Loader::helper('json');
$fh = Loader::helper('form');

echo $dh->getDashboardPaneHeaderWrapper(t('PDF Thumbs Settings'), t('Choose your preferred PDF Generation here.'), ('span8 offset2'), false); ?>

<div class="ccm-pane-body">
    <div class="row">
        <div class="span7">
            <p><?php echo t('The available PDF generation methods are listed below. The default method used is the first available. If you want to override this value, you may do so as well.') ?></p>
        </div>
    </div>
    <div class="row">
        <div class="span4 offset2">
            <dl class="dl-horizontal">
                <dt>MuPDF</dt>
                <dd>&nbsp;<?php if($PDFT_MUPDFPATH): ?><span class="badge badge-success"><i class="icon-ok-sign icon-white"></i></span><?php else: ?><span class="badge badge-warning"><i class="icon-exclamation-sign icon-white"></i></span><?php endif?></dd>
                <dt>ImageMagick</dt>
                <dd>&nbsp;<?php if($PDFT_IMPATH): ?><span class="badge badge-success"><i class="icon-ok-sign icon-white"></i></span><?php else: ?><span class="badge badge-warning"><i class="icon-exclamation-sign icon-white"></i></span><?php endif?></dd>
                <dt><?php echo t('Native')?> IMagick</dt>
                <dd>&nbsp;<?php if($PDFT_NATIVE_SUPPORT): ?><span class="badge badge-success"><i class="icon-ok-sign icon-white"></i></span><?php else: ?><span class="badge badge-warning"><i class="icon-exclamation-sign icon-white"></i></span><?php endif?></dd>
            </dl>
        </div>
    </div>
    <hr>
    <!--pre-->        <!--/pre-->
    <?php echo $fh->select('pdft_thumb_type', array('jpg'=>'JPEG', 'png'=>'PNG'), $pdft_thumb_type);?>
</div>
<div class="ccm-pane-footer">
    <div style="float:right" id="pdf-thumbs-requirements-container">

    </div>
</div>
<?php  
echo $dh->getDashboardPaneFooterWrapper(false);
// /tools/packages/pdfthumbs/pdftests

/*

PDFT_GSPATH /usr/bin/gs
PDFT_IMPATH /usr/bin/convert
PDFT_MUPDFPATH 0
PDFT_NATIVE_SUPPORT 1


*/
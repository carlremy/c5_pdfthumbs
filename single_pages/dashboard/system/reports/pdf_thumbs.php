<?php   defined('C5_EXECUTE') or die('Access Denied.');

$dh = Loader::helper('concrete/dashboard');
$th = Loader::helper('text');
$jh = Loader::helper('json');
$fh = Loader::helper('form');

echo $dh->getDashboardPaneHeaderWrapper(t('PDF Thumbs Requirements'), t('View the report below to see if your setup meets the minimum requirements for using the PDF Thumb generator job.'), false, false); ?>

<!--div class="ccm-pane-options">
	<a href="javascript:void(0)" onclick="ccm_paneToggleOptions(this)" class="ccm-icon-option-closed"><?php  echo t('Options')?></a>
	<div class="ccm-pane-options-content clearfix">
		Boos
	</div>
</div-->
<!--div class="ccm-pane-options">
	Options
</div-->
<div class="ccm-pane-body">
		<pre>
			<?php $cmd = Config::get('PDFT_MUPDFPATH');
			echo `$cmd 2>&1`;
			 ?>

		</pre>		
	<ul class="unstyled">
		<li><i class="icon-ok-sign"></i> Requirement 1 has been met</li>
		<li><i class="icon-exclamation-sign"></i> Requirement 2 has not been met</li>
		<li><i class="icon-exclamation-sign"></i> <?php echo $Foo ?></li>
	</ul>
</div>
<div class="ccm-pane-footer">
	<div style="float:right" id="pdf-thumbs-requirements-container">

	</div>
</div>
<?php  
echo $dh->getDashboardPaneFooterWrapper();

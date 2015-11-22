<?php   defined('C5_EXECUTE') or die("Access Denied.");

$dh = Loader::helper('concrete/dashboard');
$th = Loader::helper('text');
$jh = Loader::helper('json');
$fh = Loader::helper('form');

echo $dh->getDashboardPaneHeaderWrapper(t('PDF Thumbnails'), t('With this list of PDF files you can generate new previews.'), false, false); ?>
<div class="ccm-pane-body">
    <pre><?php 
        $fl = new FileList;
        
        $fl-> filterByType( FileType::T_DOCUMENT );
        $fl-> filterByExtension('pdf');
        foreach( $fl->get() as $f ) {
            $fv = $f->getVersion();
            //var_dump( get_class_methods($fv)  );
            var_dump( $fv->getPrefix() );
        }
    ?></pre>
</div>
<div class="ccm-pane-footer">
    Footer
</div>
<?php echo $dh->getDashboardPaneFooterWrapper(false);
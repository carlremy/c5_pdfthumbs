<?php defined('C5_EXECUTE') or die(_('Access denied.'));

class PdfthumbHelper {

  public function generate($file=null) {
    if(!$file InstanceOf FileVersion) return false;

    $pkg = Package::getByHandle('pdfthumbs');
    $file->createThumbnailDirectories();

    $ih = Loader::helper('image');
    $output = str_replace('.jpg', '.png', $file->getThumbnailPath(3));

    //generate a 
    $cmd = false;
    $ret = -1;
    if($pkg->config('PDFT_MUPDFPATH')) {
      $cmd = "/usr/bin/env mudraw -o $output -r 72 " . escapeshellarg($file -> getPath()) . ' 1';
    } elseif ($pkg->config('PDFT_IMPATH')) {
      $cmd = "/usr/bin/env convert " . escapeshellarg($file -> getPath()) . " $output ";
    }
      
    if($cmd) {
      @exec($cmd, $out, $ret);  
    } else {
      //run with Imagick Extension if available
      $im = new Imagick($input);
      $im->setImageFormat("png");
      if($im->writeImage($output)) {
        $ret = 0;
      }
    }

    if($ret == 0) {
      if($info = @getimagesize($output)) {
        $ih->create($output, $file->getThumbnailPath(3), $info[0], $info[1]);
        $ih->create($output, $file->getThumbnailPath(1), AL_THUMBNAIL_WIDTH, AL_THUMBNAIL_HEIGHT);
        $ih->create($output, $file->getThumbnailPath(2), AL_THUMBNAIL_WIDTH_LEVEL2, AL_THUMBNAIL_HEIGHT_LEVEL2);
        $file->refreshThumbnails();

        return true;
      }
    }
    //Do some logging here of any errors

    return false;
  }

}

<?php defined('C5_EXECUTE') or die(_('Access denied.'));

class PdfthumbHelper {

  public function generate($file=null) {
    if(!$file InstanceOf FileVersion) return false;

    $ih = Loader::helper('image');

    $pkg = Package::getByHandle('pdfthumbs');
    $file->createThumbnailDirectories();

    $output = str_replace('.jpg', '.png', $file->getThumbnailPath(3));
    $mupdf = $pkg->config('PDFT_MUPDFPATH');
    $convert = $pkg->config('PDFT_IMPATH');

    //generate a
    $cmd = false;
    $ret = -1;
    if($mupdf) {
      $cmd = "$mupdf -o $output -r 72 " . escapeshellarg($file->getPath()) . ' 1';
    } elseif ($convert) {
      $cmd = "$convert " . escapeshellarg($file -> getPath()) . " $output ";
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
    //Log::addEntry(var_export($out,1), 'PDFExOut');
    return false;
  }

}

<?php
use \Gumlet\ImageResize;
use \Gumlet\ImageResizeException;

include_once 'ImageResize.php';
include_once 'ImageResizeException.php';

class ImageLoader {
	/**
     * Class loadImageFromFile
     *
     * @param filename the name of the image
	 * @param $scale the resize ratio of the image
     * @return  the encoded image file
     * 
     */

	 public static function loadImageFromFile($filename,$scale){
		if($filename == NULL){
			throw new Exception('path is null');
			
		}
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		$image = ImageResize::createFromString($contents);
		$image->scale($scale);
		//rename the file here, Todo
	    //$image->save($filename, IMAGETYPE_PNG);
		$base64 = base64_encode($image);
		//echo $contents;
		return $base64;
	}
}
?>
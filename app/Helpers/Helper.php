<?php
namespace App\Helpers;
use Image;
use Storage;

class Helper
{
	public static function getImageThumb($image_source, $width, $height)
	{
		$thumb_dir = 'public/thumb/' . $width . 'x' . $height;
		Storage::makeDirectory($thumb_dir); // Create thumbnail directory
		$thumb_store_at = str_replace('public', 'storage', $thumb_dir);
		
		$pathArr = explode('/', $image_source);
		$filename = end($pathArr);

		$filepath = $thumb_store_at.'/'.$filename;

		if(Storage::exists($thumb_dir.'/'.$filename))
		{
			return $filepath;
		}

    	if(Image::make($image_source)->resize($width, $height)->save($filepath))
    	{
			return $filepath;
    	}
    	else
    	{
    		return false;
    	}
	}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;

class ImageThumbController extends Controller
{
    public function getImageThumb($image_source, $width, $height)
	{
		$thumb_dir = 'public/thumb/' . $width . 'x' . $height;
		$thumb_store_at = ltrim($thumb_dir, 'public/');
		Storage::makeDirectory($thumb_dir);

		$pathArr = explode('/', $image_source);
		$filename = end($pathArr);

		if(Storage::exists($thumb_dir.'/'.$filename))
		{
			return 'storage/'.$thumb_store_at .'/'.$filename;
		}

    	if(Image::make('storage/'.$image_source)->resize($width, $height)->save('storage/'.$thumb_store_at .'/'. $filename))
    	{
			return 'storage/'.$thumb_store_at .'/'.$filename;;
    	}
    	else
    	{
    		return false;
    	}
	}
}

<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class FileHelper
{
    public static function storeFile($file)
    {

        $myimage = $file->getClientOriginalName();
        $fileUrl=$file->move(public_path( 'images'), $myimage);

        return  asset('images').'/'.$myimage ;

    }

    public function removeFile($file)
    {
    if(file_exists(public_path('images'.'/'.$file))){
    unlink(public_path('images'.'/'.$file));
    }
    }
}

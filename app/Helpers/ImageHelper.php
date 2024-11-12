<?php

namespace App\helpers;

use Intervention\Image\ImageManager;

class ImageHelper
{
    public static function saveAvatar($image, $width = null, $height = null, $quality = 80)
    {
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        
        $path = storage_path('app/public/avatars/');
        $fileName = uniqid() . "." . $image->getClientOriginalExtension();
        
        $image = $manager->read($image);

        if ($width == null && $height == null) {
            $aspectRatio = $image->width() / $image->height();
            $aspectRatio > 1 ? $width = 400 : $height = 400;
        } 

        $image->scale($width, $height);
        $image->toJpeg($quality);

        $image->save($path . $fileName);

        return config("app.storage.avatars_path") . $fileName;
    }
}

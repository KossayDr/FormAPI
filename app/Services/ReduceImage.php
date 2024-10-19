<?php

namespace App\Services;

class ReduceImage
{
    public function resizeImage($file, $max_width, $max_height, $outputFile)
    {
       
        list($width, $height, $image_type) = getimagesize($file);

        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            default:
                return false;
        }

        $ratio = min($max_width / $width, $max_height / $height);
        $new_width = $width * $ratio;
        $new_height = $height * $ratio;

        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        switch ($image_type) {
            case IMAGETYPE_JPEG:
                imagejpeg($new_image, $outputFile, 75);
                break;
            case IMAGETYPE_PNG:
                imagepng($new_image, $outputFile);
                break;
            case IMAGETYPE_GIF:
                imagegif($new_image, $outputFile);
                break;
        }

        imagedestroy($image);
        imagedestroy($new_image);

        return true;
    }
}

<?php

namespace App\Services;
use Intervention\Image\ImageManagerStatic as Image;

class ImageUploader
{
    public function makeDirectory($parentDirectory, $subDirectory) {
        if(!is_dir($parentDirectory)) {
            mkdir($parentDirectory);
        }
        if (!is_dir($subDirectory)) {
            mkdir($subDirectory);
        }
    }

    private function makeImgName($slideName, $type, $imgParams) {
        $slideName = str_replace(' ', '-', $slideName);
        $igmName   = $slideName.'_'.time().".".$type;
        $imgUrl    = $imgParams[1].$igmName;
        return $imgUrl;
    }

    private function makeImage($image, $slideName, $type, $imgParams) {
        $this->makeDirectory($imgParams[0], $imgParams[1]);
        $imgUrl = $this->makeImgName($slideName, $type, $imgParams);
        Image::make($image)->resize($imgParams[2], $imgParams[3], function ($constraint) {
            $constraint->aspectRatio();$constraint->upsize();
        })->save($imgUrl);
        return $imgUrl;
    }

    public function sizeCheck($image, $slideName, $type, $imgParams) {
        $size = $image->getSize();
        if($size > $imgParams[4]) // 3145728 = 3MB
        {
            return 'largeFile';
        } else {
            $imgUrl = $this->makeImage($image, $slideName, $type, $imgParams);
            return $imgUrl;
        }
    }

    public function handleImageUpload($image, $slideName, $imgParams) {
        if ($image) {
            $type = $image->extension();
            if($type == 'jpeg' || $type == 'jpg' || $type == 'png')
            {
                $imgUrlOrError = $this->sizeCheck($image, $slideName, $type, $imgParams);
                return $imgUrlOrError;
            } else {
                return 'unSupportedFile';
            }
        }
    }
}

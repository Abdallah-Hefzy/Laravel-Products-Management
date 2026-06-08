<?php

namespace App\traits;

trait media
{

    public function uploadImage($image, $path)
    {
        if (!$image) {
            return null;
        }

        $photoName = uniqid() . '.' . $image->extension();
        $image->move(public_path($path), $photoName);
        return $photoName;
    }

    public function deleteImage($image, $path)
    {
        if (!$image) {
            return null;
        }

        $oldPhoto = $image;
        $fullPath = public_path($path . $image);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}

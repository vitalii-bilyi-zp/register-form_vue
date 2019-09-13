<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileService
{
    /**
     * Stores upload image to the given $disk.
     *
     * @param  UploadedFile  $image
     * @param  string  $disk
     * @param  string  $path
     * @return string|false
     */
    public function storeUploadedImage(UploadedFile $image, $path, $disk)
    {
        return $image->store($path, $disk);
    }
}

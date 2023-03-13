<?php

namespace App\Http;

use Illuminate\Support\Facades\Storage;

class FileServiceForAds
{
    public static function upload($file, $dir = '/', $default = '/default/default.jpg')
    {
        if ($file != null) {
            $path = $file->store($dir, 'public');
        } else {
            $path = $default;
        }
        return url('/storage/' . $path);
    }

    public static function delete($url)
    {
        $path = '/public/products/' . pathinfo($url, PATHINFO_BASENAME);

        if (Storage::exists($path) || $path == '/public/products/default.jpg') {
            return Storage::delete($path);
        }
        return false;
    }

    public static function update($dir, $old, $new = '')
    {
        if ($new != '' && $old != 'default/default.jpg') {
            FileServiceForAds::delete($old);
            return FileServiceForAds::upload($new, $dir);
        }
        return false;
    }

}

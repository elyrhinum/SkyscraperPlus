<?php

namespace App\Http;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileServiceForObjects
{
    public static function upload($file, $dir = '/', $default = 'default/default.jpg')
    {
        if ($file != null) {
            $path = $file->store($dir, 'public');
        } else {
            $path = $default;
        }
        return url('/storage/' . $path);
    }

    public static function uploadRedirect($file, $dir = '/', $default = 'default/default.jpg')
    {
        if ($file != null) {
            $path = $file->move('storage' . $dir, $file->getClientOriginalName());
        } else {
            $path = 'storage/' . $default;
        }
        return url($path);
    }

    public static function delete($url, $dir)
    {
        $path = '/public/' . $dir . pathinfo($url, PATHINFO_BASENAME);

        if (Storage::exists($path) || $path == '/public/products/default.jpg') {
            return Storage::delete($path);
        }
        return false;
    }

    public static function update($dir, $old, $new = '')
    {
        if ($new != '' && $old != 'default/default.jpg') {
            FileServiceForObjects::delete($old, $dir);
            return FileServiceForObjects::upload($new, $dir);
        }
        return false;
    }

}

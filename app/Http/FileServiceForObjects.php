<?php

namespace App\Http;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileServiceForObjects
{
    // METHOD TO UPLOAD IMAGE
    public static function upload($file, $dir = '/', $default = 'default/default.png')
    {
        if ($file != null) {
            $path = $file->store($dir, 'public');
        } else {
            $path = $default;
        }
        return url('/storage/' . $path);
    }

    // METHOD TO UPLOAD IMAGE WITH REDIRECTING
    public static function uploadRedirect($file, $dir = '/', $default = 'default/default.png')
    {
        if ($file != null) {
            $path = $file->move('storage' . $dir, $file->getClientOriginalName());
        } else {
            $path = 'storage/' . $default;
        }
        return url($path);
    }

    // METHOD TO DELETE IMAGE
    public static function delete($url, $dir)
    {
        $path = '/public/' . $dir . pathinfo($url, PATHINFO_BASENAME);

        if (Storage::exists($path) || $path != '/storage/default/default.png') {
            return Storage::delete($path);
        }
        return false;
    }

    // METHOD TO UPDATE IMAGE
    public static function update($dir, $old, $new = '')
    {
        if ($new != '' && $old != 'default/default.png') {
            FileServiceForObjects::delete($old, $dir);
            return FileServiceForObjects::uploadRedirect($new, $dir);
        }
        return false;
    }
}

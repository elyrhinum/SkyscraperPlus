<?php

namespace App\Http;

use Illuminate\Support\Facades\Storage;

class FileServiceForRealtors
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

    // METHOD TO DELETE IMAGE
    public static function delete($url)
    {
        $path = '/public/realtors/' . pathinfo($url, PATHINFO_BASENAME);

        if (Storage::exists($path) || $path == '/public/realtors/default.png') {
            return Storage::delete($path);
        }
        return false;
    }

    // METHOD TO UPDATE IMAGE
    public static function update($dir, $old, $new = '')
    {
        if ($new != '' && $old != 'default/default.png') {
            FileServiceForRealtors::delete($old);
            return FileServiceForRealtors::upload($new, $dir);
        }
        return false;
    }

}

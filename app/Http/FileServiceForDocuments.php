<?php

namespace App\Http;

use Illuminate\Support\Facades\Storage;

class FileServiceForDocuments
{
    // METHOD TO UPLOAD DOCUMENT
    public static function upload($file, $dir = '/')
    {
        if ($file != null) {
            $path = $file->store($dir, 'public');
        } else {
            return false;
        }
        return url('/storage/' . $path);
    }

    // METHOD TO DELETE DOCUMENT
    public static function delete($url)
    {
        $path = '/public/documents/' . pathinfo($url, PATHINFO_BASENAME);

        if (Storage::exists($path)) {
            return Storage::delete($path);
        }
        return false;
    }

    // METHOD TO UPDATE DOCUMENT
    public static function update($dir, $old, $new = '')
    {
        if ($new != '') {
            FileServiceForDocuments::delete($old);
            return FileServiceForDocuments::upload($new, $dir);
        }
        return false;
    }
}

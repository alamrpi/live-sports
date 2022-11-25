<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileService
{
    /**
     * Single File Upload
     * @param $file
     * @param $folder
     * @return string
     */
    public function upload($file, $folder): string
    {
        $file_name = date('Ymd') . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $logo_path = $folder . '/' . $file_name;
        $file->move($folder, $file_name);
        return $logo_path;
    }

    public function delete($path)
    {
        if(File::exists(asset($path)))
            File::delete(asset($path));
    }
}

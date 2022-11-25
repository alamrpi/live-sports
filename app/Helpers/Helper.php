<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function getSlug($title, $model): string
    {
        $slug = Str::slug($title);
        $slugCount = count( $model->whereRaw("url REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }
}

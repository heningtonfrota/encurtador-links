<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Link;

class SlugGenerator
{
    public static function generateUniqueSlug(): string
    {
        do {
            $randomSlug = Str::random(8);
            $slugExists = Link::where('slug', $randomSlug)->exists();
        } while ($slugExists);

        return $randomSlug;
    }
}

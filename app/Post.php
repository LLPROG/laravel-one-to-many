<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug'];

    // funzione di generazione dello slug
    static public function slugGenerator($originalString) {

        $originalSlug = Str::of($originalString)->slug('-');
        $updatedSlug = $originalSlug;
        $_i = 1;

        while(self::where('slug', $updatedSlug)->first()) {
            $updatedSlug = "$originalSlug-$_i";
            $_i++;
        }

        return $updatedSlug;
    }
}

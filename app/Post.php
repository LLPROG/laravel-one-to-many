<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function userInfos ()

    {
        return $this->hasOne('App\UserInfo');
    }

    public function User ()

    {
        return $this->belongTo('App\User');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = ['title', 'content', 'slug'];

    // funzione di generazione dello slug
    static public function slugGenerator($originalString) {

        $originalSlug = Str::of($originalString)->slug('-')->__toString();
        $updatedSlug = $originalSlug;
        $_i = 1;

        while(self::where('slug', $updatedSlug)->first()) {
            $updatedSlug = "$originalSlug-$_i";
            $_i++;
        }

        return $updatedSlug;
    }
}

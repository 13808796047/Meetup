<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['title', 'content'];

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }
}

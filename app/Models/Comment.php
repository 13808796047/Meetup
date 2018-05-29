<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['issue_id', 'user_id', 'content'];

    public function issue()
    {
        return $this->belongsTo('App\Models\Issue');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

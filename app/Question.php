<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function tag()
    {
        return $this->hasMany('App\Tag');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}

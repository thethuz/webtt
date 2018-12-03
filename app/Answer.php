<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answers";

    public $timestamps = true;

    // public function parent()
    // {
    //     return $this->belongsTo('App\Answer', 'answer_id');
    // }
    //
    // public function children()
    // {
    //     return $this->hasMany('App\Answer','answer_id');
    // }

    public function user(){
        return $this->belongsTo('App\User','user_id', 'id');
    }


    public function children()  
    {
        return $this->hasMany('App\Answer', 'answer_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Answer', 'answer_id');
    }
}

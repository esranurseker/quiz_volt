<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    public $timestamps = [];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function answer(){
        return $this->belongsTo(Answer::class,'answer_id');
    }

    public function my_result(){
        return $this->hasOne('App\Models\Result')->where('user_id',auth()->user()->id);
    }

}

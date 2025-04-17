<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function userAnswers(){
        return $this->hasMany(UserAnswer::class,'answers_id','id');
    }

    public function isCorrect(){
        return $this->option ? true : false;
    }
}

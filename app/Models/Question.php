<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $appends = ['true_percent'];

    public function getTruePercentAttribute(){
        $answer_count = $this->userAnswers()->count();

        if($answer_count == 0){
            return 0;
        }
        $true_answer = $this->userAnswers()->whereHas('answer',function($query){
            $query->where('option',1);
        })->count();

        return round((100/ $answer_count) * $true_answer);

    }

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }

    public function my_answers(){
        return $this->hasMany('App\Models\Answer');
    }

    public function userAnswers(){
        return $this->hasMany(UserAnswer::class)->where('user_id',auth()->user()->id);
    }
}

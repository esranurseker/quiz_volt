<?php

namespace App\Livewire\Forms;

use App\Models\Quiz;
use App\Models\Result;
use App\Models\UserAnswer;
use Livewire\Form;

class QuizzesForm extends Form
{
    
    public ?Quiz $quiz = null;
    public $my_result;
    public $quizzes;
    public $result;
    public $userAnswers;
    public $answers;
    public $quizId;
    public $question;
    public $correctAnswers;
    public $answer;
    public $option;
    public $point;
    public $wrong;

    public function quizzesDetail(string $slug){
        $this->quiz = Quiz::withCount('questions')->with(['my_result','topTen.user'])->firstWhere('slug',$slug);
    }

    public function quizJoin($slug){
        $this->quiz = Quiz::with(['questions','questions.answers','my_result'])->firstWhere('slug',$slug);

        if($this->quiz->my_result){
            return redirect()->route('quizzes.quizdetail' , $this->quiz->slug);
        }

        $this->result = Result::updateOrCreate([
            'user_id' => auth()->user()->id,
            'quiz_id' => $this->quiz->id,
        ],[
            'point' => 0,
            'correct' => 0,
            'wrong' => 0
        ]);
         $this->userAnswers = collect(UserAnswer::where('user_id',auth()->id())->where('quiz_id',$this->quiz->id)->get());
    }

    public function quizResult($slug){
        $this->quiz = Quiz::with(['questions','questions.answers','questions.my_answers','my_result'])->firstWhere('slug',$slug);
        $this->userAnswers = UserAnswer::whereUserId(auth()->user()->id)->whereQuizId($this->quiz->id)->get();

    }

    public function selectAnswer($answer_id, $question_id){
        UserAnswer::updateOrCreate([
            'user_id' => auth()->user()->id,
            'question_id' => $question_id,
            'quiz_id' => $this->quiz->id
        ],[
            'answer_id' => $answer_id
        ]);
        $this->userAnswers = collect(UserAnswer::where('user_id',auth()->id())->where('quiz_id',$this->quiz->id)->get());
    }

    public function quizJoinSubmit(){
        $answers = UserAnswer::where('user_id',auth()->user()->id)->whereQuizId($this->quiz->id)->get();

        $correctAnswers = [];
        $wrongAnswers = [];

        foreach($answers as $answer){
            if($answer->answer->isCorrect()){
                $correctAnswers [] = $answer;
            }
            else {
                $wrongAnswers [] = $answer;
            }
        }

        $questionCount = count($this->quiz->questions);
        $point = ($questionCount > 0) ? round((100 / $questionCount) * count($correctAnswers)) : 0;

        $this->result->update([
            'point' => $point,
            'correct' => count($correctAnswers),
            'wrong' => count($wrongAnswers)
        ]);

    }

    
    
}

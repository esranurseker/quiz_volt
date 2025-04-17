<?php

namespace App\Livewire\Forms;

use App\Models\Answer;
use App\Models\Question;
use Livewire\Attributes\Validate;
use Livewire\Form;


class QuestionForm extends Form
{
    public ?Question $question;
    #[Validate('required|min:3')]
    public $quest;

    #[Validate('nullable|max:1024|mimes:jpg,jpeg,png')]
    public $image;
    public $quiz_id;
    public $answers = [];
    public $id;

    public $isSubmitting = false;

    public function questionEdit(Question $question){
        $this->question = $question;
        $this->quiz_id = $question->quiz_id;
        $this->quest = $question->question;
        $this->image = $question->image;
        $this->answers = $question->answers->map(fn($q) => [
            'answer' => $q->answer,
            'option' => (bool) $q->option,
            'question_id' => $this->question->id
        ])->toArray();
    }
    

    public function save(){
        if($this->isSubmitting) return;
        
        $this->isSubmitting = true;

        $this->validate();

        $imagePath = $this->image ? $this->image->store('images','public') : null;

        $newQuestion = Question::updateOrCreate([
            'id' => $this->id,
            ],[
            'question'=> $this->quest,
            'image' => $imagePath,
            'quiz_id' => $this->quiz_id
        ]);



        foreach($this->answers as $answer){
            Answer::updateOrCreate([
                'id'=> $this->id,
            ], [
                'answer' => $answer['answer'],
                'option' => $answer['option'],
                'question_id' => $newQuestion->id
            ]);
        }
        $this->reset();
    }
    
    
    public function imageDelete(){
        if($this->question->image){
            \Storage::disk('public')->delete($this->question->image);
            $this->question->image = null;
            $this->question->save();
            $this->image = null;
        }
    }
    
}

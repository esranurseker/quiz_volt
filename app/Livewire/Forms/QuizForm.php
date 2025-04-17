<?php

namespace App\Livewire\Forms;

use App\Models\Quiz;
use Livewire\Attributes\Validate;
use Livewire\Form;

class QuizForm extends Form
{

    public ?Quiz $quiz;

    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required|max:1000')]
    public $description = '';

    #[Validate('required|date|after:now')]
    public $finished_at = '';

    #[Validate('required')]
    public $status = '';
    #[Validate('nullable')]    
    public $id;
    public function quizEdit(Quiz $quiz){
        $this->quiz = $quiz;
        $this->title = $quiz->title;
        $this->description = $quiz->description;
        $this->finished_at = $quiz->finished_at;
        $this->status = $quiz->status;
        $this->id = $quiz->id;
    }

     
    public function save() {
        $this->validate();
        Quiz::updateOrCreate([
            'id' => $this->id,
        ],[
            'title' => $this->title,
            'description' => $this->description,
            'finished_at' => $this->finished_at,
            'status' => $this->status,
        ]);
    }

    

    public function show($id){
        $this->quiz = Quiz::withCount('questions')->with(['my_result','topTen.user','results' => function($query) {
            $query->with('user')->orderByDesc('point');
        }])->firstWhere('id',$id);
    }


    
}

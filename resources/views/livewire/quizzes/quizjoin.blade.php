<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\QuizzesForm;

new class extends Component {
    public QuizzesForm $form;

    public $listeners = ['submit'];

    public static function params(){
        return ['slug'];
    }

    public function mount(string $slug){
         $this->form->quizJoin($slug);
    }

    public function submit(){
        $this->form->quizJoinSubmit();
        return $this->redirectRoute('quizzes.quizresult',['slug' => $this->form->quiz->slug]);
    }

    public function selectAnswer($answer_id,$question_id){
        $this->form->selectAnswer($answer_id,$question_id);
    }

    
}; ?>

<div>
   <div x-data="countdownTimer({{ $form->quiz->finished_at?->timestamps ?? now()->addMinutes(1)->timestamp }})" x-init="init()" id="countdown" wire:ignore class=" fixed right-9 top-1/10 transform -translate-y-1 text-[#edb4bd] float-right bg-gray-100 px-2 py-3 rounded-lg font-medium">
      <span x-text="minutes"></span>:<span x-text="seconds"></span>
   </div>
   <form wire:submit="submit">
      @foreach ($form->quiz->questions as $question)
        @if($question->image)
           <img src="{{ asset($question->image) }}" class=" w-60 mb-4 mt-5 rounded-md">
        @endif
        <strong class="text-[#efb4be]">{{ $loop->iteration }} . &nbsp; {{ $question->question }}</strong>  
        @foreach ($question->answers as $answer)
         <div class="flex items-center mb-4 mt-4" wire:key="a-{{ $question->id }}">
            <button type="button" wire:click="selectAnswer({{ $answer->id }},{{ $question->id }})"
              @class([
                "bg-gray-200 py-1 px-2 rounded-full text-[#8fb6cb] focus:bg-[#ba8e95] focus:text-gray-300 dark:bg-white ",
                'bg-green-600  text-white' => $form->userAnswers->firstWhere('question_id',$question->id)?->answer_id == $answer->id,
                ])>
                {{ chr(64 + $loop->index+1) }}
            </button>
            <label for="{{ $question->id }}-{{ $answer->id }}" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-100">{{ $answer->answer }}</label>
         </div>
        @endforeach
           @if (!$loop->last)
              <hr>
           @endif
    @endforeach
    <button class="flex justify-center  items-center  w-60  px-3 mt-10 py-2 mb-3 text-sm font-medium text-center text-gray-50 bg-[#8fb6cb] rounded-lg focus:ring-4 focus:outline-none focus:ring-[#aed0e2] dark:bg-gray-100 dark:hover:bg-gray-500 dark:text-gray-800 dark:focus:ring-lime-800">Sınavı Bitir</button>
   </form>
</div>

<script>
    function countdownTimer(endTime){
        return {
            minutes: '10',
            seconds: '00',
            interval:null,
            init(){
                this.update();
                this.interval =setInterval(() => {
                    this.update();
                },1000);
            },
            
            update(){
                const now = Math.floor(Date.now() / 1000);
                const remaining = endTime -now;

                if(remaining <= 0){
                    clearInterval(this.interval);
                    this.minutes = '00';
                    this.seconds = '00';
                    Livewire.dispatch('submit');
                    return;
                }

                this.minutes =String(Math.floor(remaining / 60)).padStart(2,'0');
                this.seconds =String(remaining % 60).padStart(2,'0');
            }
        }
    }
</script>

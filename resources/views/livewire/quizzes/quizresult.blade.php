<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\QuizzesForm;

new class extends Component {
    public QuizzesForm $form;

    public static function params(){
        return ['slug'];
    }
    public function mount(string $slug){
        $this->form->quizResult($slug);
    }
}; ?>

<div>
    <h2 class="text-center mb-10 text-[#edb4bd] font-medium">{{ $form->quiz->title }} Sonucu</h2>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative overflow-hidden rounded-lg mb-5 p-6 border border-neutral-200 dark:border-amber-100">
                <div class="mb-4 flex gap-3">
                    <h4 class="font-bold">Sınav Adı: </h4>
                    <span>{{ $form->quiz->title }}</span>
                </div>
                <div class="mb-4 flex gap-3">
                    <h4 class="font-bold">Sınav Açıklması: </h4>
                    <span>{{ $form->quiz->description }}</span>
                </div>
                <div class="mb-4 flex gap-3">
                    <h4 class="font-bold">Kullanıcı Adı: </h4>
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <div class="mb-4 flex gap-3">
                    <h4 class="font-bold">E-posta: </h4>
                    <span>{{ auth()->user()->email }}</span>
                </div>
            </div>
            <div class="relative overflow-hidden rounded-lg mb-5 p-6 border bg-[#EFF1DB] border-neutral-200 dark:border-neutral-200">
                <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
                    <div role="button" class="flex items-center justify-between  w-full p-3 text-gray-800 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        Sıralama
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/30">
                                <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">#{{ $form->quiz->my_rank }}</span>
                            </div>
                        </div>
                    </div>
                    <div role="button" class="flex items-center justify-between  w-full p-3 text-gray-800 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        Puan
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/30">
                                <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">{{ $form->quiz->my_result->point }}</span>
                            </div>
                        </div>
                    </div>
                    <div role="button" class="flex items-center justify-between  w-full p-3 text-gray-800 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        Doğru Sayısı
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/30">
                                <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">{{ $form->quiz->my_result->correct }}</span>
                            </div>
                        </div>
                    </div>
                    <div role="button" class="flex items-center justify-between  w-full p-3 text-gray-800 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        Yanlış Sayısı
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/30">
                                <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">{{ $form->quiz->my_result->wrong }}</span>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="relative h-full grid grid-cols-3 overflow-hidden rounded-xl py-5 px-5 border border-neutral-200 dark:border-gray-700">
            <div class="grid grid-cols-1 gap-20 md:grid-cols-2 lg:grid-cols-2">
                <div class="w-5 h-5 ml-10 bg-green-500 rounded-full">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                    </svg>
                </div>
                <h4 class="-mt-18 md:-mt-1 md:-ml-20 lg:-mt-1 lg:-ml-20">Doğru Cevap</h4>
            </div>
            <div class="grid grid-cols-1 gap-20 md:grid-cols-2 lg:grid-cols-2">
                <div class="w-5 h-5 ml-10  bg-red-400 rounded-full">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
                    </svg>
                </div>
                <h4 class="-mt-18 md:-mt-1 md:-ml-20 lg:-mt-1 lg:-ml-20">Yanlış Cevap</h4>
            </div>
            <div class="grid grid-cols-1 gap-20 md:grid-cols-2 lg:grid-cols-2">
                <div class="w-5 h-5 ml-10 bg-gray-400  rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z" />
                    </svg>
                </div>
                <h4 class="-mt-18 md:-mt-1 md:-ml-20 lg:-mt-1 lg:-ml-20">Senin Cevabın</h4>
            </div>
        </div>
    </div>
    @foreach ($form->quiz->questions as $question)
        
      @if ($question->image)
         <img src="{{ asset($question->image) }}" class=" w-40 mb-4 mt-5 rounded-md">
      @endif
      <small class="float-right mt-12 text-[#edb4bd] bg-gray-200/20 py-2 px-3 rounded-lg">
        Bu soruya <strong>%{{ $question->true_percent }}</strong> oranında doğru cevap verildi.
      </small>
      <br>
      @if(optional($form->userAnswers->where('question_id',$question->id)->first())?->answer && optional($form->userAnswers->where('question_id',$question->id)->first())?->answer?->isCorrect())
      <div class="w-5 mt-5 mb-5 bg-green-500 rounded-full">
               <svg viewBox="0 0 512 512">
                    <path
                       d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
               </svg>
      </div>
      @else
      <div class="w-5 mt-5 mb-5 bg-red-400 rounded-full">
            <svg viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path
                    d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z" />
            </svg>
      </div>
      @endif
      <div>
        <strong>{{ $loop->iteration }}. &nbsp; {{ $question->question }}</strong>
         @foreach ($question->answers as $answer)
           <div class="flex items-center mb-4 mt-4">
            @if ($answer->option == 1)
              <div class="w-5  bg-green-500 rounded-full">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z" />
                    </svg>
              </div>
              @elseif(optional(optional($form->userAnswers->where('question_id',$question->id)->first())->answer)->id === $answer->id)
                <div class="w-5 bg-gray-400   rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                           <path
                               d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z" />
                        </svg>
                </div>
            @endif
            <div class="flex items-center mb-4 mt-4" wire:key="a-{{ $question->id }}">
                <label for="{{ $question->id }}-{{ $answer->id }}" class="ms-2 text-sm font-medium text-gray-700 dark:text-gray-100">{{ $answer->answer }}</label>
            </div>
           </div>
         @endforeach
         @if (!$loop->last)
            <hr>
         @endif
      </div>
    @endforeach

</div>

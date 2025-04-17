<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\QuestionForm;
use App\Models\Quiz;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public QuestionForm $form;
    public function submit(){
        $this->form->save();

        return $this->redirect('/admin/questions/index');
    }

    public function with(){
        return [
            'quizzes' => Quiz::all(),
        ];
    }
}; ?>

<div>
    <div x-data="{
      answers: @entangle('form.answers').live,
      answerBlade: {
        answer: '',
        option: false
      },
      addAnswer(){
        this.answers.push(this.answerBlade);
        this.answerBlade={answer: '', option: false}
      }
    }"
    class="max-w-7xl sm:max-w-full sm:p-4 p-6  dark:bg-gray-800 dark:border-gray-700">
        <div>
            <h2 class="text-fuchsia-800 font-bold text-center">Soru Oluştur</h2>
        </div>
        <div class="mt-20">
            <form x-ref="form" wire:submit.prevent="submit" class="max-w-sm mx-auto">
                <div class="mb-5">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Soru</label>
                    <input wire:model="form.quest" type="question" name="question" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB] focus:border-[#EFF1DB] block w-full p-2.5 dark:border-gray-600 dark:placeholderbg-gray-400 dark:text-white ">
                    <div class="text-red-500 mt-2">
                        @error('form.quest')<span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fotoğraf
                        </label>
                        <input id="image" wire:model="form.image"  type="file" name="image"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] focus:outline-none focus:ring-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "></input>
                        <div class="text-red-500 mt-4">
                            @error('form.image') <span class="error">{{ $message }}</span>@enderror
                        </div>
                </div>
                <div class="relative max-w-sm mt-5">
                   <label for="quiz">Sınav Seç</label>
                   <select wire:model="form.quiz_id" name="quiz" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] focus:outline-none focus:ring-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white ">
                        <option value="">Sınav Seçiniz</option>
                          @foreach ($quizzes as $quiz)
                             <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                          @endforeach
                            
                       
                    </select>
                </div>

                <template x-for="(soru,index) in answers" : key="index">
                    <div class="mt-1 flex items-center gap-4">
                       <span class="inline-flex items-center rounded-l-md px-3 text-sm text-gray-500">
                          <input x-model="soru.option" :checked="soru.option" type="checkbox" class="bg-gray-50 border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] focus:outline-none focus:ring-1  block w-full  p-2.5  dark:border-gray-600 dark:placeholder-gray-400">
                       </span>
                          <input type="text" x-model="soru.answer" placeholder="Cevap Giriniz" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB] focus:border-[#EFF1DB] block w-full p-2.5 dark:border-gray-600 dark:placeholderbg-gray-400 dark:text-white ">
                    </div>
                </template>

                <div>
                    <div class="flex items-center gap-4 mt-5">
                        <input type="checkbox" x-model="answerBlade.option">
                        <input type="text" x-model="answerBlade.answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB] focus:border-[#EFF1DB] block w-full p-2.5 dark:border-gray-600 dark:placeholderbg-gray-400 dark:text-white">
                        <div>
                            <button @click="addAnswer" type="button" class="inline-flex mt-4 items-center float-right px-3 py-2 text-sm font-medium text-center text-gray-800 bg-gray-200/20 rounded-lg hover:bg-[#EFF1DB] hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#EFF1DB] dark:hover:bg-[#EFF1DB] dark:focus:ring-[#EFF1DB]">Cevap Ekle</button>
                        </div>

                    </div>
                </div>

                <div>
                   <button type="submit"  class="flex w-full h-full justify-center  items-center px-3 mt-6 py-2 mb-3 shadow-lg shadow-[#D3B5E5]  text-sm font-medium text-center text-gray-700 bg-[#EFF1DB] rounded-lg hover:bg-white hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#EFF1DB] dark:hover:bg-gray-400 dark:focus:ring-[#EFF1DB]">Soru Oluştur</button>
                </div>
            </form>
            
        </div>

    </div>
</div>

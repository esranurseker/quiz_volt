<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\QuestionForm;
use App\Models\Question;
use Livewire\WithFileUploads;


new class extends Component {
    use WithFileUploads;

    public QuestionForm $form;

    public function mount(Question $question){
        $this->form->questionEdit($question);
    }

    public function submit(){
        $this->form->save();
 
        return $this->redirect('/admin/questions/index');
    }

    public function imageDelete(){
        $this->form->imageDelete();
    }
    
}; ?>

<div x-data="{
    answers: @entangle('form.answers').live,
    answerBlade: {
        answer: '',
        option: false
      },
      addAnswer(){
        this.answers.push(this.answerBlade);
        this.answerBlade={answer: '', option: false}
      },
      deleteEvent(id){
      $data.answers = $data.answers.filter((_,i) => i !== id);
      }
}"  class="max-w-7xl sm:max-w-full sm:p-4 p-6  dark:bg-gray-800 dark:border-gray-700">
      <div>
          <h2 class="text-fuchsia-800 font-bold text-center">Soruyu Güncelle</h2>
      </div>
        <div class="mt-20">
            <form x-ref="form" wire:submit.prevent="submit" class="max-w-sm mx-auto">
                <div class="mb-5">
                    <label for="question" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Soru</label>
                    <input wire:model="form.quest" type="question" name="question" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB] focus:border-[#EFF1DB] block w-full p-2.5 dark:border-gray-600 dark:placeholderbg-gray-400 dark:text-white ">
                </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fotoğraf</label>
                     @if($form->question?->image)
                      <div class="grid grid-cols-2 gap-4">
                        <a href="{{ asset($form->question->image) }}" target="_blank">
                            <img src="{{ asset($form->question->image) }}" class="w-40 mb-5 mt-3 rounded-md">
                        </a>
                        <div>
                            <button type="button" wire:click="imageDelete" class="inline-flex items-center float-right mt-20 px-3  py-2 mb-3 text-sm font-medium text-center text-gray-800 bg-[#EFF1DB] rounded-lg hover:bg-white hover:text-gray-700 focus:ring-4 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#EFF1DB] dark:hover:bg-white dark:focus:ring-[#EFF1DB]">Resmi Sil</button>
                        </div>
                      </div>
                     @endif
                        <input id="image" wire:model="form.image"  type="file" name="image" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] focus:outline-none focus:ring-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "></input>
                </div>
                

                <template x-for="(soru,index) in answers" : key="index">
                    <div class="mt-1 flex items-center gap-4">
                       <span class="inline-flex items-center rounded-l-md px-3 text-sm text-gray-500">
                          <input x-model="soru.option" :checked="soru.option" type="checkbox" class="bg-gray-50 border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] focus:outline-none focus:ring-1  block w-full  p-2.5  dark:border-gray-600 dark:placeholder-gray-400">
                       </span>
                          <input type="text" x-model="soru.answer" placeholder="Cevap Giriniz" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB] focus:border-[#EFF1DB] block w-full p-2.5 dark:border-gray-600 dark:placeholderbg-gray-400 dark:text-white ">
                          <button type="button" @click="deleteEvent(index)" class="font-normal text-fuchsia-700 dark:text-gray-200 hover:underline">Sil</button>
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
                   <button type="submit"  class="flex w-full h-full justify-center  items-center px-3 mt-6 py-2 mb-3 shadow-lg shadow-[#D3B5E5]  text-sm font-medium text-center text-gray-700 bg-[#EFF1DB] rounded-lg hover:bg-white hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#EFF1DB] dark:hover:bg-gray-400 dark:focus:ring-[#EFF1DB]">Soruyu Güncelle</button>
                </div>
            </form>
            
        </div>
</div>

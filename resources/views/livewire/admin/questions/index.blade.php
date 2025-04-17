<?php

use Livewire\Volt\Component;
use App\Models\Question;
use Livewire\WithPagination;


new class extends Component {
    use WithPagination;
    public $question;

    public function with(){
        return [
            'questions' => Question::orderBy('created_at','desc')->paginate(10)
        ];
    }

    public function delete($id){
        Question::find($id)->delete();
        return back();
    }
}; ?>

<div>
<div class="flex justify-center items-center">
        <h2 class="font-bold text-fuchsia-600/60 ">Sorular</h2>
    </div>
    <div>
        <a href="{{ route('admin.questions.create') }}" class="inline-flex items-center text-sm mt-10 ml-10 font-medium text-center py-2 px-3 rounded-lg  bg-[#BBE7FE] text-gray-700  hover:bg-white  hover:text-gray-700 focus:ring-1 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#BBE7FE] dark:hover:bg-gray-100 dark:focus:ring-[#EFF1DB]   shadow-lg shadow-[#FFD4DB]">Soru Oluştur</a>
        <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center text-sm mt-10 ml-10 font-medium text-center py-2 px-3 rounded-lg text-gray-700 bg-gray-200  hover:bg-white  hover:text-gray-700 focus:ring-1 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#BBE7FE]  dark:hover:bg-gray-100 dark:focus:ring-[#EFF1DB] shadow-lg shadow-[#FFD4DB]">Sınavlara Dön</a>
    </div>
    <div  class="relative overflow-x-auto shadow-lg shadow-[#FFD4DB] mt-10 rounded-lg lg:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-500 dark:text-white"> 
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Sorular
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fotoğraf
                    </th>
                    <th scope="col" class="px-6 py-3">
                        İşlemler
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                
               
                <tr class="odd:bg-white odd:dark:bg-gray-50 even:bg-gray-200 even:dark:bg-gray-50 border-b dark:border-gray-500 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-800">
                        {{ $question->question }}
                    </th>
                    <td class="px-6 py-4">
                        @if($question->image)
                          <a href="{{ asset($question->image) }}" class="font-medium bg-[#EFF1DB] py-3 px-2 rounded-lg text-gray-700 dark:text-gray-200 dark:bg-gray-500 " target="_blank">Görüntüle</a>
                          @endif
                    </td>
                    <td class="px-6 py-4">
                       <a href="{{ route('admin.questions.edit',['question' => $question->id]) }}"  class="font-medium text-stone-400 dark:text-gray-500 hover:underline">Düzenle</a>
                       <a wire:click="delete({{ $question->id }})" wire:confirm="Soruyu Silmek İsyiyor Musunuz ?" class="font-medium text-stone-900 dark:text-lime-800 hover:underline">Sil</a>
                    </td>
                     
                </tr>
                @endforeach
            </tbody>

        </table>
        &nbsp;
        {{ $questions->links() }}

    </div>
</div>

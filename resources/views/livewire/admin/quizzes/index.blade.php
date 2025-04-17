<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Quiz;

new class extends Component {
    use WithPagination;
    public $title;
    public $status;
 
    public function with(): array
    {
        return [
            'quizzes' => Quiz::withCount('questions')
            ->when($this->title, fn($query) => 
            $query->where('title','like','%'.$this->title.'%'))
           ->when($this->status && $this->status !== 'Durum Seçiniz', fn($query) => 
             $query->where('status','like','%'.$this->status.'%'))->paginate(5),
        ];
    }

    function delete($id){
        Quiz::findOrFail($id)->delete();
    }

}

?>

<div>
    <div>
        <a href="{{ route('admin.quizzes.create') }}" class="bg-[#BBE7FE] text-white inline-flex items-center text-sm mt-10 ml-10 font-medium text-center py-2 px-3 rounded-lg hover:bg-white hover:text-[#BBE7FE] focus:ring-4 focus:ring-blue-100 dark:bg-[#1e293b]">Sınav Oluştur</a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 mt-8 ml-8">
        <div>
            <input type="text" wire:model.live="title" name="title" placeholder="Sınav Adı" class="border border-gray-300 py-2 px-3 rounded-lg text-gray-800 hover:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring-1 dark:bg-white">
        </div>
        <div class="mb-10 mt-4 lg:-ml-20 lg:mt-2 md:ml-54 md:-mt-9">
            <select name="status" wire:model.live="status" id="status" class="text-[#87ccf1] bg-gray-200 py-2 px-3 rounded-lg -mt-1">
                <option>Durum Seçiniz</option>
                <option @if(request()->get('quiz==status') == 'publish') selected @endif value="publish">Aktif</option>
                <option @if(request()->get('quiz==status') == 'passive') selected @endif value="passive">Pasif</option>
                <option @if(request()->get('quiz==status') == 'draft') selected @endif value="draft">Taslak</option>
            </select>
            @if($title || $status)
            <div class="-mt-8 ml-36">
               <a href="" class="bg-[#87ccf1] rounded-lg py-2 px-3 text-white mb-3 ml-5 font-medium text-center hover:bg-white hover:text-[#BBE7FE] focus:outline-none focus:ring-blue-300 dark:bg-blue-400 dark:hover:bg-gray-200 dark:focus:ring-blue-800">Sıfırla</a>
            </div>
            @endif
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-lg shadow-[#FFD4DB] sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-lime-900">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-lime-900 dark:text-white ">
            <tr>
                <th scope="col" class="px-6 py-3">
                   Sınavlar
                </th>
                <th scope="col" class="px-6 py-3">
                  Soru Sayısı
                </th>
                <th scope="col" class="px-6 py-3">
                  Durum
                </th>
                <th scope="col" class="px-6 py-3">
                  Bitiş Tarihi
                </th>
                <th scope="col" class="px-6 py-3">
                  İşlemler
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
            <tr class="odd:bg-white odd:dark:bg-gray-50 even:bg-gray-200 even:dark:bg-gray-50 border-b dark:border-gray-500 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-800">
                  {{ $quiz->title }}
                </th>
                <td class="px-6 py-4">
                    {{ $quiz->questions_count }}
                </td>
                <td class="px-6 py-4">
                  @switch($quiz->status)
                     @case('publish')
                       @if($quiz->finished_at > now())
                          <span class="text-green-600/80 font-medium text-sm">Aktif</span>
                       @else()
                          <span class="text-gray-500/50 font-medium text-sm">Süresi Bitmiş</span>
                       @endif
                       @break
                       @case('passive')
                           <span class="text-red-700 font-medium text-sm">Pasif</span>
                        @break
                        @case('draft')
                           <span class="text-yellow-600/80 font-medium text-sm">Taslak</span>
                        @break
                    @endswitch
                </td>
                <td class="px-6 py-4">
                   {{ $quiz->finished_at ? now()->parse($quiz->finished_at)->diffForHumans() : '-' }}
                </td>
                <td class="px-6 py-4">
                    <div x-data="{open : false}" class="relative inline-block text-left">
                        <button @click="open = !open" class="inline-flex justify-center w-full rounded-md bg-gray-300/30 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none">
                            Detay
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 -mt-1 w-36  origin-top-right rounded-md border border-[#FFD4DB]  bg-white shadow-lg ring-1 ring-[#FFD4DB] ring-opacity-5 focus:outline-none">
                            <div class="py-1 text-sm">
                                <a href="{{ route('admin.quizzes.edit' , ['quiz' => $quiz->id]) }}" class="text-[#FFD4DB] block px-4 py-2 text-sm dark:text-gray-800" role="menuitem" tabindex="-1">Düzenle</a>
                                <a href="{{ route('admin.quizzes.show',$quiz->id) }}" class="text-[#FFD4DB] block px-4 py-2 text-sm dark:text-gray-800" role="menuitem" tabindex="-1">Bilgi</a>
                                <a href="{{ route('admin.quizzes.questions',['quiz' => $quiz->id]) }}" class="text-[#FFD4DB] block px-4 py-2 text-sm dark:text-gray-800" role="menuitem" tabindex="-1">Sorular</a>
                                <button wire:confirm="Silmek İstiyor Musunuz?" wire:click="delete({{ $quiz->id }})" class="text-[#FFD4DB] block px-4 py-2 text-sm dark:text-gray-800" role="menuitem" tabindex="-1">Sil</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
         @endforeach
        </tbody>
    </table>
        &nbsp;
        {{ $quizzes->links() }}
      

    </div>
</div>

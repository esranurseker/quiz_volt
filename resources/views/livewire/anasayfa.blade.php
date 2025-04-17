<?php

use Livewire\Volt\Component;
use App\Models\Quiz;
use Livewire\WithPagination;
use App\Models\Result;

new class extends Component {
    use WithPagination;

    public $results;

    public function mount(){
        $this->results = Result::where('user_id',auth()->user()->id)->get();
    }
    
    public function with(){
        return [
            'quizzes' => Quiz::where(function($query) {
               $query->whereNotNull('finished_at')->orWhere('finished_at', '>', now());
            })->where('status','publish')->withCount('questions')->with(['my_result'])->paginate(5)
        ];
    }
}; ?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4  grid-cols-1 lg:grid-cols-2">
            <div class="relative  overflow-hidden rounded-xl">
                <div class="text-center">
                    <ul class="bg-gray-50 rounded-lg shadow divide-y divide-gray-200 w-full">
                        @foreach($quizzes as $quiz)
                        <a href="{{ route('quizzes.quizdetail',['slug' => $quiz->slug]) }}">
                            <li class="px-6 py-4">
                                <div class="flex justify-between">
                                    <span class=" text-lg text-[#ba8e95] mb-2">{{ $quiz->title }}</span>
                                    <span class="text-gray-600 text-xs">{{ $quiz->finished_at ? now()->parse($quiz->finished_at)->diffForHumans() : '-' }}</span>
                                </div>
                                <p class="text-gray-700 mb-4 text-md">
                                   {{ $quiz->description }}
                                </p>
                                <small class="bg-[#BBE7FE] text-gray-700 py-2 px-3 rounded-md">{{ $quiz->questions_count }} Soru</small>

                            </li>
                        </a>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4">
                     {{ $quizzes->links() }}
                </div>
            </div>

            <div class="relative overflow-hidden  rounded-xl mb-5 p-6 bg-[#EFF1DB] border border-neutral-200  dark:border-neutral-700 lg:w-[400px] lg:h-max">
                <div class="text-center mb-4">
                    Sınav Sonuçları
                </div>
                <div class="relative  shadow-lg  sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-white dark:text-gray-400">
                        <thead class="text-gray-700  dark:text-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Puan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sınav Adı
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                              <tr class="bg-[#EFF1DB] border-b shadow-2xl shadow-gray-900 dark:border-gray-700 dark:text-black border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-700 whitespace-nowrap dark:text-black">
                                    <strong>{{ $result->point }}</strong>
                                </th>
                                <td class="px-6 py-4 text-gray-700">
                                     <a href="{{ route('quizzes.quizdetail',$quiz->slug) }}">
                                        {{ $result->quiz->title }} 
                                     </a>
                                </td>

                              </tr>
                            
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>


        </div>
    </div>
</div>

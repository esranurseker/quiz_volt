<?php

use Livewire\Volt\Component;
use App\Models\Quiz;
use App\Livewire\Forms\QuizzesForm;

new class extends Component {
    public QuizzesForm $form;

    public static function params(){
        return ['slug'];
    }

    public function mount(string $slug)
    {
        $this->form->quizzesDetail($slug);
    }

    
}; ?>

<div>
   <h2 class="text-center mb-10 text-[#ba8e95]  dark:text-white">{{ $form->quiz->title }}  Sınavı</h2>
   <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
     <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-4 dark:border-lime-700  dark:bg-gray-50 dark:text-black">
            <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
                <div role="button" class="flex items-center justify-between w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                   Soru Sayısı
                   <div class="grid ml-auto place-items-center justify-self-end">
                      <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                          <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full">{{ $form->quiz->questions_count }}</span>
                      </div>
                   </div>
                </div>
                @if($form->quiz->finished_at)
                <div role="button" class="flex items-center justify-between w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Son Katılım Tarihi
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full">{{ $form->quiz->finished_at ? now()->parse($form->quiz->finished_at)->diffForHumans() : '-' }}</span>
                        </div>
                    </div>
                </div>
                @endif
                @if($form->quiz->details !==null)
                <div role="button" class="flex items-center justify-between w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Katılımcı Sayısı
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full">{{ $form->quiz->details['join_count'] }}</span>
                        </div>
                    </div>
                </div>
                <div role="button" class="flex items-center justify-between w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Ortalama Puan
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full">{{ $form->quiz->details['average'] }}</span>
                        </div>
                    </div>
                </div>
               @endif
            </nav>
        </div>
         @if($form->quiz->my_result)
        <div class="relative overflow-hidden rounded-xl bg-[#BBE7FE] border  border-neutral-200 dark:border-4 dark:border-gray-200">
            <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
                <div role="button" class="flex items-center justify-between  w-full p-3 text-white leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Sıralama
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">#{{ $form->quiz->my_rank }}</span>
                        </div>
                    </div>
                </div>

                <div role="button" class="flex items-center justify-between  w-full p-3 text-white leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Puan
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">{{ $form->quiz->my_result->point }}</span>
                        </div>
                    </div>
                </div>

                <div role="button" class="flex items-center justify-between  w-full p-3 text-white leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Doğru Sayısı
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">{{ $form->quiz->my_result->correct }}</span>
                        </div>
                    </div>
                </div>

                <div role="button" class="flex items-center justify-between  w-full p-3 text-white leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    Yanlış Sayısı
                    <div class="grid ml-auto place-items-center justify-self-end">
                        <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                            <span class="bg-white py-2 px-3 text-[#ba8e95] rounded-full text-sm">{{ $form->quiz->my_result->wrong }}</span>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        @endif
        @if(count($form->quiz->topTen) > 0)
        <div class="relative  overflow-hidden rounded-xl border border-neutral-200 dark:border-4 dark:border-lime-700 dark:bg-white">
            <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
                <div class="scrollbar scrollbar-thumb-sky-700 scrollbar-track-sky-300 h-72 overflow-y-scroll snap-y scroll-smooth overflow-auto">
                    <h5 class="mb-5 text-[#ba8e95] font-semibold text-center">İlk 10'a Girenler</h5>
                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700"> 
                        @foreach($form->quiz->topTen as $result)
                        <li class="pb-3 sm:pb-4 text-gray-600">
                            <div class="grid grid-cols-2 mt-3">
                                <div>
                                    <strong class="mr-3">{{ $loop->iteration }}.</strong>
                                    <span>{{ $result->user->name}}</span>
                                </div>
                                <div class="grid ml-auto place-items-center justify-self-end">
                                    <div class=" px-2 py-1  font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-200/60">
                                        <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full text-xs text-center  ml-5 mt-2">{{ $result->point }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                </div>
            </nav>
        </div>
       @endif
     </div>
     <div class="relative h-full flex-1 overflow-hidden rounded-xl text-center border border-neutral-200 dark:border-4 dark:border-lime-700 dark:bg-white">
        <p class="mb-3 mt-5 px-3 py-2 font-normal text-gray-700 dark:text-gray-800">{{ $form->quiz->description }}</p>
        @if($form->quiz->my_result)
        <a href="{{ route('quizzes.quizresult', ['slug' => $form->quiz->slug]) }}" class="inline-flex items-center px-3 py-2 text-sm mt-24 mb-5 font-medium text-center text-[#edb4bd] bg-gray-200 rounded-lg hover:bg-white focus:ring-4 focus:outline-none hover:text-[#edb4bd]  focus:ring-gray-300 dark:bg-gray-300 dark:hover:bg-gray-50 dark:focus:ring-gray-300">Sınavı Görüntüle</a>
        @elseif($form->quiz->finished_at < now())
        <p class="mt-8 mb-5 text-[#FFD4DB]">Sınava Katılım Süresi Bitti</p>
        @elseif($form->quiz->finished_at > now())
        <a href="{{ route('quizzes.quizjoin' , ['slug' => $form->quiz->slug]) }}" class="inline-flex items-center px-3 py-2 text-sm mt-20 mb-5 font-medium text-center text-white bg-[#edb4bd] rounded-lg hover:bg-white focus:ring-4 focus:outline-none hover:text-[#edb4bd]  focus:ring-[#f2c4cb] dark:bg-[#edb4bd] dark:hover:bg-gray-50 dark:focus:ring-gray-300">Sınava Başla</a>
        @endif


     </div>

   </div>
</div>

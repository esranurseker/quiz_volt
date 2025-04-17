<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\QuizForm;

new class extends Component {
    public QuizForm $form;

    public function mount($id){
        $this->form->show($id);
    }

}; ?>

<div>
    <div class="text-center text-[#ba8e95] dark:text-white">
        <h2>{{ $form->quiz->title }}</h2>
    </div>
    <div>
       <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center text-sm mt-10 ml-10 font-medium text-center py-2 px-3 rounded-lg text-gray-700 bg-gray-200  hover:bg-white  hover:text-gray-700 focus:ring-1 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#BBE7FE]  dark:hover:bg-gray-100 dark:focus:ring-[#EFF1DB] shadow-lg shadow-[#FFD4DB]">Sınavlara Dön</a>
    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 mt-8 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative  overflow-hidden rounded-xl border border-neutral-200   dark:border-neutral-700 dark:bg-white dark:text-gray-900">
                <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
                    <div role="button" class="flex items-center justify-between w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        Soru Sayısı
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                                <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full">{{ $form->quiz->questions_count }}</span>
                            </div>
                        </div>
                    </div>
                    <div role="button" class="flex items-center justify-between w-full p-3 leading-tight transition-all rounded-lg outline-none text-start hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                        Son Katılım Tarihi
                        <div class="grid ml-auto place-items-center justify-self-end">
                            <div class="relative grid items-center px-2 py-1 font-sans text-xs font-bold text-gray-900 uppercase rounded-full select-none whitespace-nowrap bg-gray-900/10">
                                <span class="bg-[#BBE7FE] py-2 px-3 text-white rounded-full">{{ $form->quiz->finished_at ? now()->parse($form->quiz->finished_at)->diffForHumans() : '-' }}</span>
                            </div>
                        </div>
                    </div>
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
                </nav>
            </div>
            @if (count($form->quiz->topTen) > 0)
               <div class="relative overflow-hidden rounded-xl bg-white border border-neutral-200 dark:border-neutral-700">
                  <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-blue-gray-700">
                    <div class="scrollbar scrollbar-thumb-sky-700 scrollbar-track-sky-300 h-72 overflow-y-scroll snap-y scroll-smooth overflow-auto">
                        <h5 class="mb-5 text-[#ba8e95] font-semibold text-center">İlk 10'a Girenler</h5>
                        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($form->quiz->topTen as $result)
                              <li class="pb-3 sm:pb-4 text-gray-600">
                                <div class="grid grid-cols-2 mt-3">
                                    <div>
                                        <strong class="mr-3">{{ $loop->iteration }}.</strong>
                                        <span>{{ $result->user->name }}</span>
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

        <div class="max-w-full p-6 bg-white border text-center border-gray-200  rounded-lg  dark:bg-white dark:text-black dark:border-gray-700">
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-800">{{ $form->quiz->description }}</p>
            <div class="relative overflow-x-auto bg-[#EFF1DB] text-[#866369] shadow-2xl shadow-[#FFD4DB] rounded-lg  lg:rounded-lg mt-5">
                <table class="w-full  text-sm text-left  rtl:text-right  dark:text-gray-200">
                    <thead class="font-bold uppercase bg-[#EFF1DB] text-[#80a1b6] dark:bg-lime-700 dark:text-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Ad Soyad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Puan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Doğru Sayısı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Yanlış Sayısı
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($form->quiz->results as $result)
                          <tr class=" border-b dark:border-gray-700 border-[EFF1DB]">
                            <td scope="row" class="px-6 py-4 font-medium  whitespace-nowrap  dark:text-white">
                                {{ $result->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $result->point }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $result->correct }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $result->wrong }}
                            </td>
                          </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

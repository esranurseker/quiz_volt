<?php


use Livewire\Volt\Component;
use App\Livewire\Forms\QuizForm;

new class extends Component 
{
    public QuizForm $form;

    public function submit(){
        $this->form->save();

        return $this->redirect('/admin/quizzes/index');
    }
    
}

?>

<div>
    <div>
        <h2 class="text-fuchsia-800 font-bold text-center ">Sınav Oluştur</h2>
    </div>
    <div class="block items-center justify-center">
        <div class="mt-20">
            <form x-ref="form" wire:submit.prevent="submit" class="max-w-sm mx-auto">
                <div class="mb-5">
                    <label for="title" clas∑s="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sınav Başlığı</label>
                    <input wire:model.live="form.title" type="title" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB] focus:border-[#EFF1DB] block w-full p-2.5 dark:border-gray-600 dark:placeholderbg-gray-400 dark:text-white ">
                    <div class="text-red-500 mt-2">
                        @error('form.title')<span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sınav Açıklaması</label>
                    <textarea wire:model="form.description" name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#EFF1DB] "></textarea>
                    <div class="text-red-500 mt-2">
                    @error('form.description')<span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="relative max-w-sm mt-5">
                    <label for="status">Sınav Durumu</label>
                    <select wire:model="form.status"  name="status" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#EFF1DB] focus:border-[#EFF1DB] focus:outline-none focus:ring-1  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#EFF1DB]">
                        <option  value="publish">Aktif</option>
                        <option  value="passive">Pasif</option>
                        <option  value="draft">Taslak</option>
                    </select>
                    <div class="text-red-500 mt-2">
                        @error('form.status')<span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="relative max-w-sm mt-5">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input wire:model="form.finished_at" type="datetime-local" id="finishedInput"  name="finished_at"
                    type="datetime-local"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#EFF1DB]  focus:border-[#EFF1DB] focus:outline-none focus:ring-1 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select date">
                <div class="text-red-500 mt-4">
                   @error('form.finished_at')<span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <button type="button" wire:click="submit" class="flex w-full h-full justify-center  items-center px-3 mt-6 py-2 mb-3   text-sm font-medium text-center text-gray-700 bg-[#EFF1DB] rounded-lg hover:bg-white hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-[#EFF1DB] dark:bg-[#EFF1DB] dark:hover:bg-gray-400 dark:focus:ring-[#EFF1DB]">Sınav Oluştur</button>
            </div>
            </form>

        </div>

    </div>
</div>

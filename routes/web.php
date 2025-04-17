<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function(){
    Volt::route('anasayfa','anasayfa')->name('anasayfa');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Route::middleware(['auth'])->group(function(){
     Route::redirect('admin','admin/quizzes/index');

     Volt::route('admin/quizzes/index','admin.quizzes.index')->name('admin.quizzes.index');
     Volt::route('admin/quizzes/create','admin.quizzes.create')->name('admin.quizzes.create');
     Volt::route('admin/quizzes/{quiz}/edit','admin.quizzes.edit')->name('admin.quizzes.edit');
     Volt::route('admin/quizzes/{quiz}/questions','admin.quizzes.questions')->name('admin.quizzes.questions');
     Volt::route('admin/quizzes/{id}/show','admin.quizzes.show')->name('admin.quizzes.show');

     Volt::route('admin/questions/index','admin.questions.index')->name('admin.questions.index');
     Volt::route('admin/questions/create','admin.questions.create')->name('admin.questions.create');
     Volt::route('admin/questions/{question}/edit','admin.questions.edit')->name('admin.questions.edit');
});

Route::middleware(['auth'])->group(function() {
    
    Volt::route('quizzes/quiz/detay/{slug}','quizzes.quizdetail')->name('quizzes.quizdetail');
    Volt::route('quizzes/start/{slug}','quizzes.quizjoin')->name('quizzes.quizjoin');
    Volt::route('quizzes/quiz/{slug}/result','quizzes.quizresult')->name('quizzes.quizresult');
});     


require __DIR__.'/auth.php';

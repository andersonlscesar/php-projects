<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/', function () { 
    return view('welcome');
});


Route::controller(ContactController::class)->name('contacts.')->group(function () { 

    Route::get('/contacts', 'index')->name('index');
    
    Route::get('/contacts/create', 'create')->name('create');
    
    Route::get('/contacts/{id}', 'show')->whereNumber('id')->name('show');

});

Route::fallback(function () {
    return "<h1>Esta página não existe</h1>";
});
<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WelcomeController;



Route::get('/', WelcomeController::class);



Route::prefix('admin')->group(function () {

    Route::controller(ContactController::class)->name('contacts.')->group(function () {
        Route::get('/contacts', 'index')->name('index');    
        Route::get('/contacts/create', 'create')->name('create');    
        Route::get('/contacts/{id}', 'show')->whereNumber('id')->name('show');
    });


});
Route::resource('/companies', CompanyController::class);
Route::resources([
    '/tags' => TagController::class,
    'tasks' => TaskController::class
]);

// Route::resource('/activities', ActivityController::class)->except([
//     'index', 'show'
// ]);

// Route::resource('/contacts.notes', ContactNoteController::class)->shallow();

// Route::resource('/activities', ActivityController::class)->names([
//     'index' => 'activities.all',
//     'show'  => 'activities.view'
// ]);

// Route::resource('/activities', ActivityController::class)->parameters([
//     'activities'    => 'active'
// ]);

Route::fallback(fn() => '<h1>Sorry, the page does not exist</h1>');


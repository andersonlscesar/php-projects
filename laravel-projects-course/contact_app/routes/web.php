<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

function getContacts() {
    return  [
        // 1 => ['id' => 1, 'name' => 'Anderson César', 'phone' => '79991426969'],
        // 2 => ['id' => 2, 'name' => 'Jhully Nascimento', 'phone' => '79581365'],
        // 3 => ['id' => 3, 'name' => 'Ana Rebelo', 'phone' => '79852365']
    ];
}

Route::get('/', function () { 
    return view('welcome');
});


Route::get('/contacts', function () {

    $companies = [
        1 => ['name' => 'Company Google', 'contacts' => 3],
        2 => ['name' => 'Company Oracle', 'contacts' => 5]
    ];

    $contacts = getContacts();

    return view('contacts.index', compact('contacts', 'companies'));
})->name('contacts.index');

Route::get('/contacts/create', function () {
    return view('contacts.create');
})->name('contacts.create');

Route::get('/contacts/{id}', function ($id) {
    $contacts = getContacts();
    abort_unless(isset($contacts[$id]), 404, 'User not found');
    $contact = $contacts[$id];
    return view('contacts.show')->with('contact', $contact);
})->whereNumber('id')->name('contacts.show');

Route::fallback(function () {
    return "<h1>Esta página não existe</h1>";
});
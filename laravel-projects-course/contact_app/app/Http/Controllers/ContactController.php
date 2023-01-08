<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $companies = [
            1 => ['name' => 'Company Google', 'contacts' => 3],
            2 => ['name' => 'Company Oracle', 'contacts' => 5]
        ];
    
        $contacts = $this->getContacts();
    
        return view('contacts.index', compact('contacts', 'companies'));
    }

    protected function getContacts()
    {
        return  [
            1 => ['id' => 1, 'name' => 'Anderson César', 'phone' => '79991426969'],
            2 => ['id' => 2, 'name' => 'Jhully Nascimento', 'phone' => '79581365'],
            3 => ['id' => 3, 'name' => 'Ana Rebelo', 'phone' => '79852365']
        ];
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        $contacts = $this->getContacts();
        abort_unless(isset($contacts[$id]), 404, 'User not found');
        $contact = $contacts[$id];
        return view('contacts.show')->with('contact', $contact);
    }
}

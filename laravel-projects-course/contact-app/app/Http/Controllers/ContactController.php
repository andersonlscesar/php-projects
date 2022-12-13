<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    protected $company;

    public function __construct(CompanyRepository $company)
    {
        $this->company = $company;
    }

    private function getContacts(): array {
        return [
            1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '123456789'],
            2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '123456789'],
            3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '123456789']
        ];
    }

    
    public function index(CompanyRepository $company, Request $request)
    {
        // dd($request->sort_by);
        // $companies = [
        //     1 => ['name' => 'Company One', 'Contacts' => 3],
        //     2 => ['name' => 'Company Two', 'Contacts' => 5]
        // ];
        $companies = $company->pluck();
        $contacts = $this->getContacts();
        return view('contacts.index', compact('contacts', 'companies'));
    }


    public function create()
    {
        return view('contacts.create');
    }
    
    public function show(Request $request, $id)
    {
        $contacts = $this->getContacts();
        abort_unless(isset($contacts[$id]), 404);
        $contact =$contacts[$id];
        return view('contacts.show')->with('contact', $contact);
    }
}

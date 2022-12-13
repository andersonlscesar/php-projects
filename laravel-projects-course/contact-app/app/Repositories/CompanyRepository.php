<?php
namespace App\Repositories;

class CompanyRepository
{
    public function pluck(): array
    {
        return [
            1 => 'Company One',
            2 => 'Company Two'
        ];
    }
}
<?php
namespace App\Controller\Api;

class Api
{
    public static function details($request): array
    {
        return [
            'nome'      => 'Api - web',
            'versao'    => 'v1.0.0',
            'autor'     => 'Anderson César',
            'email'     => 'andersonlscesar@gmail.com'
        ];
    }
}
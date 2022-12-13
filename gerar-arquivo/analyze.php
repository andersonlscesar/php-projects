<?php
require_once __DIR__ . '/autoload.php';

use App\GenerateFile;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!empty($_POST['nome']) && !empty($_POST['texto'])) {
        $filename = $_POST['nome'];
        $texto = $_POST['texto'];
        $generator = new GenerateFile($filename, $texto);
        $generator->generate();
        $generator->excludeFile();

    } else {
        header('Location: index.html?status=preencha-todos-os-campos');
        exit;
    }

}
// $filegenerator = new GenerateFile('tst','olá, mundo');

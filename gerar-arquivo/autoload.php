<?php
function autoload($classname) {
    $extension = spl_autoload_extensions();   
    if(file_exists($classname.$extension)) {
        require_once __DIR__ . '/' . $classname . $extension;
    }
}

spl_autoload_extensions('.php'); 
spl_autoload_register('autoload');
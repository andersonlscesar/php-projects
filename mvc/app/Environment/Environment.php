<?php
namespace App\Environment;

class Environment
{
    public static function load($dir)
    {

        if (file_exists($dir)) {
            $lines = file($dir);

            foreach($lines as $line)
            {
                putenv(trim($line));
            }
            return true;
        }

        return false;
    }
}
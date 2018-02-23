<?php
namespace src;


/** auto load */
autoload(__DIR__ . "/content");


echo "server is about to start\n";
flush();
sleep(3);
echo "loading resisted\n";


function autoload($path)
{
    $dir_handle = openDir($path);

    while (false !== $file = readDir($dir_handle)) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path . '/' . $file)) {
            autoload($path . '/' . $file);
        }
        require_once $path . "/{$file}";
    }
    closeDir($dir_handle);
}

<?php
namespace src;


/** auto load */
use content\server\SwitchBoardServer;

autoload(__DIR__ . "/content");


echo "server is about to start\n";
flush();
sleep(1);
$server = new SwitchBoardServer();
$server->start('127.0.0.1', 9502);



function autoload($path)
{
    /**
    $dir_handle = openDir($path);

    while (false !== $file = readDir($dir_handle)) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path . '/' . $file)) {
            return autoload($path . '/' . $file);
        }
        echo $path . "/{$file}\n";
    }
    closeDir($dir_handle);
     * */
    require_once 'content/core/Logger.php';
    require_once 'content/core/TCPServerBase.php';
    require_once 'content/server/SwitchBoardServer.php';
}

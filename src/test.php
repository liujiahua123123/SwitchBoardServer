<?php
namespace src;


/** auto load */
use content\protocol\defaults\ServerPongPacket;
use content\protocol\Packet;
use content\server\SwitchBoardServer;

seq_autoload();


echo "server is about to start\n";
flush();
sleep(1);
/*
$server = new SwitchBoardServer();
$server->start('127.0.0.1', 9502);
*/
$pk = new ServerPongPacket();
$pk->note = 1;
$pk->message = "message";
Packet::encodePacket($pk);
Packet::decodePacket($pk);
echo $pk->getNetworkId(). "\n";
echo $pk->message. "\n";
echo $pk->note. "\n";



function seq_autoload(){
    autoload(__DIR__ . "/content/core");
    require_once "content/protocol/Packet.php";
    autoload(__DIR__ . "/content");
}
function autoload($path)
{
    $dir_handle = openDir($path);

    while (false !== $file = readDir($dir_handle)) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path . '/' . $file)) {
            autoload($path . '/' . $file);
            continue;
        }
        require_once $path . "/{$file}";
    }
    closeDir($dir_handle);
}



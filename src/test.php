<?php
namespace src;


/** auto load */
use content\protocol\defaults\ServerPongPacket;
use content\protocol\Packet;
use content\server\SwitchBoardServer;

seq_autoload();


echo "switchboard is about to start\n";
flush();
sleep(1);
/*
$switchboard = new SwitchBoardServer();
$switchboard->start('127.0.0.1', 9502);
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
    autoload(__DIR__ . "/switchboard/core");
    require_once "switchboard/protocol/Packet.php";
    autoload(__DIR__ . "/switchboard");
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



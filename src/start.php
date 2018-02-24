<?php
namespace src;


require_once __DIR__."osmiumDB/localStorage/JSON.php";
/** auto load */
use content\protocol\defaults\ServerPongPacket;
use content\protocol\Packet;
use content\server\SwitchBoardServer;
use osmiumDB\localStorage\JSON;

const PROTOCOL_VERSION = 1;
const SERVER_VERSION = 1;
const SERVER_ROLE = 1;
const CONFIG_FILE = "config.json";

seq_autoload();

//config部分
$config = [
    "port"=>9502,
    "server-name"=>"switchboard",
    "key"=>generate_password()
];

$json = new JSON(__DIR__.CONFIG_FILE,$config);
$json->setDefault();//如果没有内容就写入默认值
$json->save();//保存
//加载config
$config = $json->getAll();


echo "server is about to start\nconfig info:";
var_dump($config);
flush();
sleep(1);
echo "protocol version ".PROTOCOL_VERSION;
echo "server role".SERVER_ROLE;
echo "please check key in config.json";


$server = new SwitchBoardServer();
$server->start('127.0.0.1', $config["port"]);


function seq_autoload(){
    autoload(__DIR__ . "/content/core");
    require_once "content/protocol/Packet.php";
    autoload(__DIR__ . "/content");
}

function autoload($path){
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


function generate_password( $length = 8 ){
// 密码字符集，可任意添加需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|’';
    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $password;
}


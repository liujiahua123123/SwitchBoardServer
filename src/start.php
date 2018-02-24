<?php
namespace src;


/** auto load */
require_once __DIR__."/osmiumDB/SimpleClassLoader.php";
$loader = new \OsmiumDB\SimpleClassLoader();
$loader->readPath(__DIR__."/",true);

use content\protocol\defaults\ServerPongPacket;
use content\protocol\Packet;
use content\server\SwitchBoardServer;
use osmiumDB\localStorage\JSON;use osmiumDB\SimpleClassLoader;

define("PROTOCOL_VERSION",1);
define("SERVER_VERSION",1);
define("SERVER_ROLE",1);
const CONFIG_FILE = "config.json";

seq_autoload();

//config部分
$config = [
    "port"=>9502,
    "server-name"=>"switchboard",
    "key"=>generate_password()
];

$json = new JSON(__DIR__.CONFIG_FILE,$config);
//加载config
$config = $json->getAll();


echo "server is about to start\nconfig info:\n";
var_dump($config);
flush();
sleep(1);
echo "\nprotocol version | ".PROTOCOL_VERSION;
echo "\nserver role | ".SERVER_ROLE;
echo "\nplease check key in config.json\n";


$server = new SwitchBoardServer();
$server->start('127.0.0.1', $config["port"]);



function generate_password( $length = 8 ){
// 密码字符集，可任意添加需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|’';
    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $password;
}


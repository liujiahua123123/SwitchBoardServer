<?php
$client = new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);
$client->on("connect",function (swoole_client $cil){
    $cil->send("Hello, connected");
});
$client->on("receive",function (swoole_client $cli,$data){
    echo "receive" . $data . "\n";
    $cli->send("Hello,");
});
$client->on("error",function ($cli){
    echo "error\n";
});
$client->on("close",function ($cli){
    echo "close";
});
$client->connect("127.0.0.1",9502,0.5);
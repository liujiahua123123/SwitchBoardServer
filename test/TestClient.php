<?php
$client = new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);
$client->on("connect",function (swoole_client $cil){

});
$client->on("receive",function ($cli,$data){
    echo "receive" . $data . "\n";
});
$client->on("error",function ($cli){
    echo "error\n";
});
$client->on("close",function ($cli){
    echo "close";
});
$client->connect("127.0.0.1",9502,0.5);
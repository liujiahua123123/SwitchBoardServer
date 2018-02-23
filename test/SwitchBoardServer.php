<?php
$server = new swoole_server('127.0.0.1',9502);
$server->on('connect',function (swoole_server $server,$fd){
    echo 'open' . $fd;
    $server->send($fd,"swoole: connected");
});
$server->on('receive',function (swoole_server $server,$fd,$from_id,$data){
    echo "data" . $data . "\n" . "id" . $from_id;
    $server->send($fd,"swoole receive({$data})");
});
$server->start();
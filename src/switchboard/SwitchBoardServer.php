<?php
namespace switchboard;

class SwitchBoardServer extends TCPServer {

    public function onStart(){
        $this->log("SwitchBoardServer:: start on protocol ".PROTOCOL_VERSION);
    }

    function onReceive($swoole, $fd, $from_id, $data)
    {
        $this->log("SwitchBoardServer: receive data from: " . $fd);
    }

    function onConnect($swoole, $fd)
    {
        $this->log("SwitchBoardServer connected by: " . $fd);
    }

    function onClose($swoole, $fd)
    {
        $this->log("SwitchBoardServer disconnected by: " . $fd);
    }

}
<?php
namespace switchboard\protocol\defaults;


use switchboard\protocol\Packet;

class ServerPongPacket extends Packet {
    const NETWORK_ID = 2;

    public $message = "+PONG";

    function encode()
    {
        $this->reset();
        $this->putString($this->message);
    }

    function decode()
    {
        $this->message = $this->getString();
    }
}
<?php
namespace switchboard\protocol\defaults;


use switchboard\protocol\Packet;

class ServerPongPacket extends Packet {
    const NETWORK_ID = 1;

    public $message = "+PONG";
    public $note = 0;


    function encode()
    {
        $this->putString($this->message);
        $this->putInt($this->note);
    }

    function decode()
    {
        $this->message = $this->getString();
        $this->note = $this->getInt();
    }

}
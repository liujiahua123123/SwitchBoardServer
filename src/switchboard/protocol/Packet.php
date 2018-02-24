<?php
namespace switchboard\protocol;

use switchboard\protocol\binary\BinaryStream;

abstract class Packet extends BinaryStream {
    const NETWORK_ID = 0;
    public $isEncoded = false;

    public function getNetworkId(){
        return $this::NETWORK_ID;
    }

    abstract function encode();

    abstract function decode();

    public function isEncode(){
        return $this->isEncoded;
    }

    public function __construct(string $buffer = "", int $offset = 0)
    {
        parent::__construct($buffer, $offset);
    }


    public static function encodePacket(Packet $packet){
        $packet->reset();
        $packet->putInt($packet->getNetworkId());
        $packet->encode();
        return $packet;
    }

    public static function decodePacket(Packet $packet){
        $netWork = $packet->getInt();
        $packet->decode();
        return $packet;
    }


}
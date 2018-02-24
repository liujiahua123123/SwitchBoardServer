<?php
namespace switchboard\utils;
class Logger{
    public static function log($message,$level=LogLevel::INFO){
        switch($level){
            case LogLevel::EMERGENCY:
                self::emergency($message);
                break;
            case LogLevel::ALERT:
                self::alert($message);
                break;
            case LogLevel::CRITICAL:
                self::critical($message);
                break;
            case LogLevel::ERROR:
                self::error($message);
                break;
            case LogLevel::WARNING:
                self::warning($message);
                break;
            case LogLevel::NOTICE:
                self::notice($message);
                break;
            case LogLevel::INFO:
                self::info($message);
                break;
            case LogLevel::DEBUG:
                self::debug($message);
                break;
        }
    }


    public static function emergency($message, $name = "EMERGENCY"){
        self::send($message, LogLevel::EMERGENCY, $name, TextFormat::RED);
    }
    public static function alert($message, $name = "ALERT"){
        self::send($message, LogLevel::ALERT, $name, TextFormat::RED);
    }
    public static function critical($message, $name = "CRITICAL"){
        self::send($message, LogLevel::CRITICAL, $name, TextFormat::RED);
    }
    public static function error($message, $name = "ERROR"){
        self::send($message, LogLevel::ERROR, $name, TextFormat::DARK_RED);
    }
    public static function warning($message, $name = "WARNING"){
        self::send($message, LogLevel::WARNING, $name, TextFormat::YELLOW);
    }
    public static function notice($message, $name = "NOTICE"){
        self::send($message, LogLevel::NOTICE, $name, TextFormat::AQUA);
    }
    public static function info($message, $name = "INFO"){
        self::send($message, LogLevel::INFO, $name, TextFormat::WHITE);
    }

    public static function debug($message, $name = "DEBUG"){
        self::send($message, LogLevel::DEBUG, $name, TextFormat::GRAY);
    }

    public static function send($msg,$level,$name,$color){
        $now = time();
        $message = TextFormat::toANSI(TextFormat::AQUA . "[" . date("H:i:s", $now) . "] " . TextFormat::RESET . $color . "[SwitchBoardServer / ".$name."]:" . " " . $msg . TextFormat::RESET);
        //$message = TextFormat::toANSI(TextFormat::AQUA . "[" . date("H:i:s") . "] ". TextFormat::RESET . $color ."<".$prefix . ">" . " " . $message . TextFormat::RESET);
        $cleanMessage = TextFormat::clean($message);
        if(!Terminal::hasFormattingCodes()){
            echo $cleanMessage . PHP_EOL;
        }else{
            echo $message . PHP_EOL;
        }
    }



}
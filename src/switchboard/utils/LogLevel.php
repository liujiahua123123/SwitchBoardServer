<?php
/**
 * Author jasonczc
 */

namespace switchboard\utils;


interface LogLevel{
    const EMERGENCY = "emergency";
    const ALERT = "alert";
    const CRITICAL = "critical";
    const ERROR = "error";
    const WARNING = "warning";
    const NOTICE = "notice";
    const INFO = "info";
    const DEBUG = "debug";
}
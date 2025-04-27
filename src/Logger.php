<?php
// src/Logger.php foi criado para registrar os logs no arquivo log.txt
class Logger
{
    private static $file = __DIR__ . '/../log.txt';

    public static function info($message)
    {
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents(self::$file, "[INFO] [$timestamp] $message\n", FILE_APPEND);
    }

    public static function error($message)
    {
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents(self::$file, "[ERROR] [$timestamp] $message\n", FILE_APPEND);
    }
}

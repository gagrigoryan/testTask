<?php

class DB
{
    const USER = "root";
    const PASSWORD = "";
    const HOST = "localhost";
    const DB = "test_task";

    public static function connectDB() {
        $user = self::USER;
        $password = self::PASSWORD;
        $host = self::HOST;
        $db = self::DB;

        $conn = new PDO("mysql:dbname=$db;host=$host", $user, $password);
        return $conn;
    }
}
<?php

class Repository
{
    protected $database;

    public function __construct()
    {
        $host = '127.0.0.1';
        $dbName = 'php-crud';
        $port = 8889;
        $username = 'root';
        $password = 'root';

        $this->database = new PDO("mysql:host={$host};dbname={$dbName};port={$port}", $username, $password);
    }
}

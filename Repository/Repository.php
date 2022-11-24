<?php

class Repository
{
    protected $database;

    public function __construct()
    {
        $host = 'localhost';
        $dbName = 'php-crud';
        $port = 8889;
        $username = 'root';
        $password = 'root';

        try {
            $this->database =  new PDO("mysql:host=${host};dbname=${dbName};port=${port}", $username, $password);
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}

<?php 

include './config.php';

function getDatabaseConnection()
{
    $config = getConfig()['database'];

    try {
        return new PDO("mysql:host={$config['host']};dbname={$config['db_name']};port={$config['port']}", $config['username'], $config['password']);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }
}
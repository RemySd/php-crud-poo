<?php

ini_set('display_errors', 'On');

include './DatabaseConnection.php';

$databaseConnection = getDatabaseConnection();

$req = $databaseConnection->prepare("DELETE FROM articles WHERE id = :id");
$req->bindValue(":id", $_GET["id"], PDO::PARAM_INT);
$req->execute();

header('Location: ./index.php');

<?php

$id = $_GET['id'] ?: null;

if (empty($id)) {
    header('Location: ./index.php');
}

require_once 'config.php';
require_once './Repository/ArticleRepository.php';

$articleRepository = new ArticleRepository();
$articleToRemove = $articleRepository->getOne($id);
$articles = $articleRepository->delete($articleToRemove);

header('Location: ./index.php');

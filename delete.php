<?php

if (empty($_GET['id'])) {
    header('Location: ./index.php');
}

require_once 'config.php';
require_once './Repository/ArticleRepository.php';

$articleRepository = new ArticleRepository();
$articleToRemove = $articleRepository->getOne($_GET['id']);
$articles = $articleRepository->delete($articleToRemove);

header('Location: ./index.php');

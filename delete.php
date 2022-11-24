<?php

include './Repository/ArticleRepository.php';

$articleRepository = new ArticleRepository();
$articleToRemove = $articleRepository->getOne($_GET['id']);
$articles = $articleRepository->delete($articleToRemove);

header('Location: ./index.php');

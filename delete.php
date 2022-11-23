<?php

include './ArticleRepository.php';

$articleRepository = new ArticleRepository();
$articles = $articleRepository->delete($_GET['id']);

header('Location: ./index.php');

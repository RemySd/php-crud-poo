<?php

include './Repository/ArticleRepository.php';

$articleRepository = new ArticleRepository();
$articles = $articleRepository->delete($articleRepository->getOne($_GET['id']));

header('Location: ./index.php');

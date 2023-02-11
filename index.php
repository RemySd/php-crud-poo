<?php

require_once 'config.php';
require_once './Repository/ArticleRepository.php';

$articleRepository = new ArticleRepository();
$articles = $articleRepository->getAll();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>PHP CRUD</h1>

        <a href="./edit.php?type=add">Add an article</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Enable</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($articles as $article) {
                    ?>
                    <tr>
                        <th scope="row"><?= $article->getId() ?></th>
                        <td><?= $article->getTitle()?></td>
                        <td><?= $article->IsEnable() ? 'Yes' : 'No' ?></td>
                        <td><a href="edit.php?type=edit&id=<?= $article->getId() ?>">edit</a> | <a href="delete.php?id=<?= $article->getId() ?>">delete</a></td>
                    </tr>
                <?php
                }
?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
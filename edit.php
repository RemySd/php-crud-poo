<?php

require_once 'config.php';
require_once __ROOT__ . '/Repository/ArticleRepository.php';

$articleRepository = new ArticleRepository();

$id = empty($_GET['id']) ? null : $_GET['id'];
$article = new Article();

if ($id) {
    $article = $articleRepository->getOne($id);
}

$isEdit = empty($id) ? false : true;

if ($_POST) {
    $article->hydrate($_POST);

    if (!$isEdit) {
        $articleRepository->create($article);
    } else {
        $articleRepository->update($article);
    }

    header('Location: ./index.php');
}

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

        <a href="./index.php">Back</a>

        <?php if (!$isEdit) : ?>
            <p>New article form</p>
        <?php endif; ?>

        <form method="POST" action="./edit.php<?= $isEdit ? '?id=' . esc_html($id) : '' ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" id="title" type="text" class="form-control" aria-describedby="emailHelp" value="<?= $isEdit ? esc_html($article->getTitle()) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?= $isEdit ? esc_html($article->getContent()) : '' ?></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type='hidden' value="0" name='is_enable'>
                <input name="is_enable" value="1" type="checkbox" class="form-check-input" id="is_enable" <?= $isEdit ? ($article->isEnable() ? 'checked' : '') : '' ?>>
                <label class="form-check-label" for="is_enable">Enable</label>
            </div>

            <button type="submit" class="btn btn-primary">
                <?= $isEdit ? 'Edit' : 'Add' ?>
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
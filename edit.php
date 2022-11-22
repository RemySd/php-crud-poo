<?php

include './DatabaseConnection.php';

$databaseConnection = getDatabaseConnection();

$article = null;

// Fetch article in edit mode
if (!empty($_GET['id'])) {
    $req = $databaseConnection->prepare("SELECT * FROM articles WHERE id = :id");
    $req->bindValue(":id", $_GET["id"], PDO::PARAM_INT);
    $req->execute();
    $article = $req->fetch();
}

// Processing form when submitted
if ($_POST) {
    if ($_GET["type"] == "add") {
        $req = $databaseConnection->prepare("INSERT INTO articles VALUES (null, :title, :content, :is_enable)");
        $req->bindValue(":title", $_POST["title"], PDO::PARAM_STR);
        $req->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
        $req->bindValue(":is_enable", $_POST["is_enable"]);
        $req->execute();
    } elseif ($_GET["type"] == "edit") {
        $req = $databaseConnection->prepare("UPDATE articles SET title=:title, content=:content, is_enable=:is_enable WHERE id = :id");
        $req->bindValue(":id", $_GET["id"], PDO::PARAM_INT);
        $req->bindValue(":title", $_POST["title"], PDO::PARAM_STR);
        $req->bindValue(":content", $_POST["content"], PDO::PARAM_STR);
        $req->bindValue(":is_enable", $_POST["is_enable"]);
        $req->execute();
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

        <?php
        if (!empty($_GET["type"]) && $_GET["type"] == "add") {
            echo '<p>New article form</p>';
        }
        ?>

        <form method="POST" action="./edit.php?type=<?= !empty($_GET["type"]) && $_GET["type"] == "add" ? 'add' : 'edit&id=' . $_GET["id"] ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" id="title" type="text" class="form-control" aria-describedby="emailHelp" value="<?= !empty($article) ? $article["title"] : '' ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?= !empty($article) ? $article["content"] : '' ?></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type='hidden' value="0" name='is_enable'>
                <input name="is_enable" value="1" type="checkbox" class="form-check-input" id="is_enable" <?= !empty($article) && $article['is_enable'] == 1 ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_enable">Enable</label>
            </div>

            
            <button type="submit" class="btn btn-primary">
                <?=$_GET["type"] == "add" ? 'Add' : 'Edit' ?>
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
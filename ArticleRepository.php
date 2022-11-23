<?php

include './Repository.php';

class ArticleRepository extends Repository
{
    public function getAll(): array
    {
        return $this
            ->database
            ->query("SELECT * FROM articles")
            ->fetchAll();
    }

    public function getOne(int $articleId): array
    {
        $req = $this->database->prepare("SELECT * FROM articles WHERE id = :id");
        $req->bindValue(":id", $articleId, PDO::PARAM_INT);
        $req->execute();

        return $req->fetch();
    }

    public function create(array $data): void
    {
        $req = $this->database->prepare("INSERT INTO articles VALUES (null, :title, :content, :is_enable)");
        $req->bindValue(":title", $data["title"], PDO::PARAM_STR);
        $req->bindValue(":content", $data["content"], PDO::PARAM_STR);
        $req->bindValue(":is_enable", $data["is_enable"]);
        $req->execute();
    }

    public function update(int $articleId, array $data): void
    {
        $req = $this->database->prepare("UPDATE articles SET title=:title, content=:content, is_enable=:is_enable WHERE id = :id");
        $req->bindValue(":id", $articleId, PDO::PARAM_INT);
        $req->bindValue(":title", $data["title"], PDO::PARAM_STR);
        $req->bindValue(":content", $data["content"], PDO::PARAM_STR);
        $req->bindValue(":is_enable", $data["is_enable"]);
        $req->execute();
    }

    public function delete(int $articleId): void
    {
        $req = $this->database->prepare("DELETE FROM articles WHERE id = :id");
        $req->bindValue(":id", $articleId, PDO::PARAM_INT);
        $req->execute();
    }
}

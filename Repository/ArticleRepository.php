<?php

require_once __ROOT__ . '/Repository/Repository.php';
require_once __ROOT__ . '/Entities/Article.php';

class ArticleRepository extends Repository
{


    public function getAll(): array
    {
        $datas = $this
            ->database
            ->query("SELECT * FROM articles")
            ->fetchAll();

        $articles = [];

        foreach ($datas as $key => $value) {
            $articles[] = new Article($value);
        }

        return $articles;
    }


    public function getOne(int $id): Article
    {
        $req = $this->database->prepare("SELECT * FROM articles WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $article = new Article($req->fetch());

        return $article;
    }


    public function create(Article $article): void
    {
        $isEnable = $article->isEnable() ? '1' : '0';

        $req = $this->database->prepare("INSERT INTO articles VALUES (null, :title, :content, :is_enable)");
        $req->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
        $req->bindValue(":is_enable", $isEnable);
        $req->execute();
    }


    public function update(Article $article): void
    {
        $req = $this->database->prepare("UPDATE articles SET title=:title, content=:content, is_enable=:is_enable WHERE id = :id");
        $req->bindValue(":id", $article->getId(), PDO::PARAM_INT);
        $req->bindValue(":title", $article->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent(), PDO::PARAM_STR);
        $req->bindValue(":is_enable", $article->isEnable() ? '1' : '0');
        $req->execute();
    }


    public function delete(Article $article): void
    {
        $req = $this->database->prepare("DELETE FROM articles WHERE id = :id");
        $req->bindValue(":id", $article->getId(), PDO::PARAM_INT);
        $req->execute();
    }
}

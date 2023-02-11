<?php

class Article
{
    private int $id;
    private string $title;
    private string $content;
    private bool $isEnable;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function IsEnable(): bool
    {
        return $this->isEnable;
    }

    public function setIsEnable($isEnable): self
    {
        $this->isEnable = $isEnable;

        return $this;
    }
}

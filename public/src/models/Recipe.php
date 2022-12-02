<?php

class Recipe
{
    private $title;
    private $description;
    private $skladnik1;
    private $skladnik2;
    private $skladnik3;
    private $skladnik4;
    private $skladnik5;
    private $image;
    private $like;
    private $dislike;
    private $id;



    public function __construct($title, $description, $skladnik1, $skladnik2, $skladnik3, $skladnik4, $skladnik5, $image, $like = 0, $dislike = 0, $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->skladnik1 = $skladnik1;
        $this->skladnik2 = $skladnik2;
        $this->skladnik3 = $skladnik3;
        $this->skladnik4 = $skladnik4;
        $this->skladnik5 = $skladnik5;
        $this->image = $image;
        $this->like = $like;
        $this->dislike = $dislike;
        $this->id = $id;

    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getLike(): int
    {
        return $this->like;
    }

    public function setLike(int $like): void
    {
        $this->like = $like;
    }

    public function getDislike(): int
    {
        return $this->dislike;
    }

    public function setDislike(int $dislike): void
    {
        $this->dislike = $dislike;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////
    public function getSkladnik1(): string
    {
        return $this->skladnik1;
    }

    public function setSkladnik1(string $skladnik1)
    {
        $this->skladnik1 = $skladnik1;
    }

    public function getSkladnik2(): string
    {
        return $this->skladnik2;
    }

    public function setSkladnik2(string $skladnik2)
    {
        $this->skladnik2 = $skladnik2;
    }

    public function getSkladnik3(): string
    {
        return $this->skladnik3;
    }

    public function setSkladnik3(string $skladnik3)
    {
        $this->skladnik3 = $skladnik3;
    }

    public function getSkladnik4(): string
    {
        return $this->skladnik4;
    }

    public function setSkladnik4(string $skladnik4)
    {
        $this->skladnik4 = $skladnik4;
    }

    public function getSkladnik5(): string
    {
        return $this->skladnik5;
    }

    public function setSkladnik5(string $skladnik5)
    {
        $this->skladnik5 = $skladnik5;
    }

}
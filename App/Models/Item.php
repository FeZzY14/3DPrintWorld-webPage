<?php

namespace App\Models;

use App\Core\Model;

class Item extends Model
{
    Protected ?int $id = null;
    Protected string $picture;
    Protected string $title;
    Protected float $prize;
    Protected string $text;
    Protected string $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPrize(): float
    {
        return $this->prize;
    }

    public function setPrize(float $prize): void
    {
        $this->prize = $prize;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }


}
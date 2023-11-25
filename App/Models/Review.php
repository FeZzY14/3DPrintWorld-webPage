<?php

namespace App\Models;

use App\Core\Model;
use Cassandra\Date;

class Review extends Model
{
    Protected ?int $id = null;
    Protected int $item_id;
    Protected string $user_login;
    Protected string $text;
    Protected int $stars;
    Protected ?string $image = null;
    Protected string $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getItemId(): int
    {
        return $this->item_id;
    }

    public function setItemId(int $item_id): void
    {
        $this->item_id = $item_id;
    }

    public function getUserLogin(): string
    {
        return $this->user_login;
    }

    public function setUserLogin(string $user_login): void
    {
        $this->user_login = $user_login;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getStars(): int
    {
        return $this->stars;
    }

    public function setStars(int $stars): void
    {
        $this->stars = $stars;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

}
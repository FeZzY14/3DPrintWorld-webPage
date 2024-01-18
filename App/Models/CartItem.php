<?php

namespace App\Models;

use App\Core\Model;

class CartItem extends Model
{
    Protected int $id;
    Protected int $userId;
    Protected ?int $userItemId;
    Protected ?int $itemId;
    Protected ?string $color;
    Protected ?string $material;
    Protected ?float $layerHeight;
    Protected ?float $prize;
    Protected ?string $title;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserItemId(): ?int
    {
        return $this->userItemId;
    }

    public function setUserItemId(?int $userItemId): void
    {
        $this->userItemId = $userItemId;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(?int $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): void
    {
        $this->material = $material;
    }

    public function getLayerHeight(): ?float
    {
        return $this->layerHeight;
    }

    public function setLayerHeight(?float $layerHeight): void
    {
        $this->layerHeight = $layerHeight;
    }

    public function getPrize(): ?float
    {
        return $this->prize;
    }

    public function setPrize(?float $prize): void
    {
        $this->prize = $prize;
    }


}
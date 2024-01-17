<?php

namespace App\Models;

use App\Core\Model;

class CartOrder extends Model
{
    Protected int $id;
    Protected int $userId;
    Protected int $cartItemId;

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

    public function getCartItemId(): int
    {
        return $this->cartItemId;
    }

    public function setCartItemId(int $cartItemId): void
    {
        $this->cartItemId = $cartItemId;
    }


}
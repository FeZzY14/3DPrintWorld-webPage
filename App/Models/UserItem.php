<?php

namespace App\Models;

use App\Core\Model;

class UserItem extends Model
{
    Protected int $id;
    Protected int $userId;
    Protected string $file;
    Protected string $fileName;
    Protected string $fileType;
    Protected string $color;
    Protected string $material;
    Protected float $layerHeight;
    Protected float $prize;

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

    public function getFile(): string
    {
        return $this->file;
    }

    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFileType(): string
    {
        return $this->fileType;
    }

    public function setFileType(string $fileType): void
    {
        $this->fileType = $fileType;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function getMaterial(): string
    {
        return $this->material;
    }

    public function setMaterial(string $material): void
    {
        $this->material = $material;
    }

    public function getLayerHeight(): float
    {
        return $this->layerHeight;
    }

    public function setLayerHeight(float $layerHeight): void
    {
        $this->layerHeight = $layerHeight;
    }

    public function getPrize(): float
    {
        return $this->prize;
    }

    public function setPrize(?float $prize): void
    {
        $this->prize = $prize;
    }


}
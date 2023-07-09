<?php

namespace App\Price\DTO;

class CategoryDTO
{
    private ?int $categoryId = null;
    private ?int $parentId = null;
    private ?string $name = null;
    private ?bool $isActive = true;
    private ?bool $isRrc = false;
    private ?int $promGroupId = null;

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsRrc()
    {
        return $this->isRrc;
    }

    public function setIsRrc($isRrc)
    {
        $this->isRrc = $isRrc;

        return $this;
    }

    public function getPromGroupId()
    {
        return $this->promGroupId;
    }

    public function setPromGroupId($promGroupId)
    {
        $this->promGroupId = $promGroupId;

        return $this;
    }
}
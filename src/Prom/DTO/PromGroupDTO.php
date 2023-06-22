<?php

namespace App\Prom\DTO;

class PromGroupDTO
{
    private ?int $id = null;
    private ?int $groupId = null;
    private ?string $name = null;
    private ?string $description = null;
    private ?string $image = null;
    private ?int $parentGroupId = null;
    private ?bool $isActive = true;
    private ?int $portalId = null;
    private ?string $portalUrl = null;
    private ?string $keywords = null;
    private ?string $keywordsUkr = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getParentGroupId()
    {
        return $this->parentGroupId;
    }

    public function setParentGroupId($parentGroupId)
    {
        $this->parentGroupId = $parentGroupId;

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

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getKeywordsUkr()
    {
        return $this->keywordsUkr;
    }

    public function setKeywordsUkr($keywordsUkr)
    {
        $this->keywordsUkr = $keywordsUkr;

        return $this;
    }

    public function getPortalId()
    {
        return $this->portalId;
    }

    public function setPortalId($portalId)
    {
        $this->portalId = $portalId;

        return $this;
    }

    public function getPortalUrl()
    {
        return $this->portalUrl;
    }

    public function setPortalUrl($portalUrl)
    {
        $this->portalUrl = $portalUrl;

        return $this;
    }
}
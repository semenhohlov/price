<?php

namespace App\Prom\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity()]
#[Table(name: 'prom_groups')]
class PromGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $groupId = null;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $description = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $parentGroupId = null;

    #[ORM\Column(type: "boolean", nullable: true, options: ['default' => true])]
    private ?bool $isActive = true;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $portalId = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $portalUrl = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $keywords = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $keywordsUkr = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTime $createdAt = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTime $updatedAt = null;

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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
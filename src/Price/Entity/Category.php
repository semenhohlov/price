<?php

namespace App\Price\Entity;

use App\Prom\Entity\PromGroup;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity()]
#[Table(name: 'categories')]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $categoryId = null;
    
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $parentId = null;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Supplier::class)]
    #[ORM\JoinColumn(name: 'supplier_id', referencedColumnName: 'id')]
    private Supplier|null $supplier = null;
    
    #[ORM\ManyToOne(targetEntity: PromGroup::class)]
    #[ORM\JoinColumn(name: 'prom_group_id', referencedColumnName: 'id')]
    private PromGroup|null $promGroup = null;
    
    #[ORM\Column(type: "boolean", nullable: true, options: ['default' => true])]
    private ?bool $isActive = true;
    
    #[ORM\Column(type: "boolean", nullable: true)]
    private ?bool $isRrc = false;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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

    public function getSupplier()
    {
        return $this->supplier;
    }

    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getPromGroup()
    {
        return $this->promGroup;
    }
    public function setPromGroup($promGroup)
    {
        $this->promGroup = $promGroup;

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
}
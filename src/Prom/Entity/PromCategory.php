<?php

namespace App\Prom\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity()]
#[Table(name: 'prom_categories')]
class PromCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $portalId = null;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private ?string $portalUrl = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $category1 = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $category2 = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $category3 = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $category4 = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

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

    public function getCategory1()
    {
        return $this->category1;
    }

    public function setCategory1($category1)
    {
        $this->category1 = $category1;

        return $this;
    }

    public function getCategory2()
    {
        return $this->category2;
    }

    public function setCategory2($category2)
    {
        $this->category2 = $category2;

        return $this;
    }

    public function getCategory3()
    {
        return $this->category3;
    }

    public function setCategory3($category3)
    {
        $this->category3 = $category3;

        return $this;
    }

    public function getCategory4()
    {
        return $this->category4;
    }

    public function setCategory4($category4)
    {
        $this->category4 = $category4;

        return $this;
    }
}
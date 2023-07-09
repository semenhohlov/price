<?php

namespace App\Price\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity()]
#[Table(name: 'suppliers')]
class Supplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private ?string $prefix = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private ?string $name = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $company = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $url = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $city = null;
    
    #[ORM\Column(type: "boolean", nullable: true, options: ['default' => true])]
    private ?bool $isActive = true;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $discount = null;
    
    #[ORM\Column(type: "date", nullable: true)]
    private ?DateTime $discountBegin = null;
    
    #[ORM\Column(type: "date", nullable: true)]
    private ?DateTime $discountEnd = null;
    
    #[ORM\Column(type: "integer", nullable: true, options: ['default' => 50])]
    private ?int $firstLimit = null;
    
    #[ORM\Column(type: "integer", nullable: true, options: ['default' => 999])]
    private ?int $secondLimit = null;
    
    #[ORM\Column(type: "float", nullable: true, options: ['default' => 1.77])]
    private ?float $firstOverPrice = null;
    
    #[ORM\Column(type: "float", nullable: true, options: ['default' => 1.65])]
    private ?float $secondOverPrice = null;
    
    #[ORM\Column(type: "float", nullable: true, options: ['default' => 1.53])]
    private ?float $thirdOverPrice = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $label = null;
    
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $personalMarks = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    
    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

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

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

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

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscountBegin()
    {
        return $this->discountBegin;
    }

    public function setDiscountBegin($discountBegin)
    {
        $this->discountBegin = $discountBegin;

        return $this;
    }

    public function getDiscountEnd()
    {
        return $this->discountEnd;
    }

    public function setDiscountEnd($discountEnd)
    {
        $this->discountEnd = $discountEnd;

        return $this;
    }

    public function getFirstLimit()
    {
        return $this->firstLimit;
    }

    public function setFirstLimit($firstLimit)
    {
        $this->firstLimit = $firstLimit;

        return $this;
    }

    public function getSecondLimit()
    {
        return $this->secondLimit;
    }

    public function setSecondLimit($secondLimit)
    {
        $this->secondLimit = $secondLimit;

        return $this;
    }

    public function getFirstOverPrice()
    {
        return $this->firstOverPrice;
    }

    public function setFirstOverPrice($firstOverPrice)
    {
        $this->firstOverPrice = $firstOverPrice;

        return $this;
    }

    public function getSecondOverPrice()
    {
        return $this->secondOverPrice;
    }

    public function setSecondOverPrice($secondOverPrice)
    {
        $this->secondOverPrice = $secondOverPrice;

        return $this;
    }

    public function getThirdOverPrice()
    {
        return $this->thirdOverPrice;
    }

    public function setThirdOverPrice($thirdOverPrice)
    {
        $this->thirdOverPrice = $thirdOverPrice;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function getPersonalMarks()
    {
        return $this->personalMarks;
    }

    public function setPersonalMarks($personalMarks)
    {
        $this->personalMarks = $personalMarks;

        return $this;
    }
}
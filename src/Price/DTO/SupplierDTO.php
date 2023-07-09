<?php

namespace App\Price\DTO;

use DateTime;

class SupplierDTO
{
    private ?string $prefix = null;
    private ?string $name = null;
    private ?string $company = null;
    private ?string $url = null;
    private ?string $city = null;
    private ?bool $isActive = true;
    private ?int $discount = null;
    private ?string $discountBegin = null;
    private ?string $discountEnd = null;
    private ?int $firstLimit = null;
    private ?int $secondLimit = null;
    private ?float $firstOverPrice = null;
    private ?float $secondOverPrice = null;
    private ?float $thirdOverPrice = null;
    private ?string $label = null;
    private ?string $personalMarks = null;    

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
        return new DateTime($this->discountBegin);
    }

    public function setDiscountBegin($discountBegin)
    {
        $this->discountBegin = $discountBegin;

        return $this;
    }

    public function getDiscountEnd()
    {
        return new DateTime($this->discountEnd);
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
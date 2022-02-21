<?php

namespace App\Request\DTO\City;

use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

class DistrictDto
{
    /**
     * @JMS\Type("autoType")
     * @JMS\Groups({"create", "update"})
     * @Assert\Type(type="integer", groups={"create", "update"})
     * @SWG\Property(type="integer")
     */
    private $cityId;

    /**
     * @JMS\Type("autoType")
     * @JMS\Groups(groups={"create", "update"})
     * @Assert\Length(max = 255, groups={"create", "update"})
     * @SWG\Property(type="string")
     */
    private $districtName;

    /**
     * @JMS\Type("autoType")
     * @JMS\Groups({"create", "update"})
     * @Assert\Type(type="integer", groups={"create", "update"})
     * @SWG\Property(type="integer")
     */
    private $population;

    /**
     * @JMS\Type("autoType")
     * @JMS\Groups({"create", "update"})
     * @Assert\Type(type="numeric", groups={"create", "update"})
     * @SWG\Property(type="number")
     */
    private $area;

    public function getCityId()
    {
        return $this->cityId;
    }

    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
        return $this;
    }

    public function getDistrictName()
    {
        return $this->districtName;
    }

    public function setDistrictName($districtName)
    {
        $this->districtName = $districtName;
        return $this;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    public function setPopulation($population)
    {
        $this->population = $population;
        return $this;
    }

    public function getArea(): float
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }
}
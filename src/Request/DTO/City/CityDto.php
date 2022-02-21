<?php

namespace App\Request\DTO\City;

use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

class CityDto
{
    /**
     * @JMS\Type("autoType")
     * @JMS\Groups(groups={"create", "update"})
     * @Assert\Length(max = 255, groups={"create", "update"})
     * @SWG\Property(type="string")
     */
    private $cityName;


    public function getCityName()
    {
        return $this->cityName;
    }

    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
        return $this;
    }

}
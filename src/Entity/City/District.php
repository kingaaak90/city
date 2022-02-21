<?php

namespace App\Entity\City;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 * @ORM\Table(name="district")
 */
class District
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $districtName;

    /**
     * @ORM\Column(type="integer")
     */
    private int $population;

    /**
     * @ORM\Column(type="float")
     */
    private float $area;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City\City", inversedBy="districts")
     */
    private $city;

    public function __construct(
        City $city,
        string $districtName,
        int $population,
        float $area
    )
    {
        $this->city = $city;
        $this->districtName = $districtName;
        $this->population = $population;
        $this->area = $area;

    }

    public function update(
        string $districtName,
        int $population,
        float $area
    )
    {
        $this->districtName = $districtName;
        $this->population = $population;
        $this->area = $area;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDistrictName(): string
    {
        return $this->districtName;
    }

    public function getPopulation(): int
    {
        return $this->population;
    }


    public function getArea(): float
    {
        return $this->area;
    }


    public function getCity(): City
    {
        return $this->city;
    }

}
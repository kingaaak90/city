<?php

namespace App\Entity\City;

use App\Repository\City\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 * @ORM\Table(name="City")
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Groups({"city-list"})
     */
    private string $cityName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City\District", mappedBy="city")
     */
    private $districts;

    public function __construct(
        string $cityName
    )
    {
        $this->cityName = $cityName;
    }

    public function update(
        string $cityName
    )
    {
        $this->cityName = $cityName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCityName(): string
    {
        return $this->cityName;
    }

    /**
     * @return mixed
     */
    public function getDistricts(): Collection
    {
        return $this->districts;
    }



}
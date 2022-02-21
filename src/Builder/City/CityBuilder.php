<?php

namespace App\Builder\City;

use App\Entity\City\City;

class CityBuilder
{
    private string $cityName;

    private string $districtName;

    private float $population;

    private float $area;

    public function getCityName(): string
    {
        return $this->cityName;
    }

    public function setCityName(string $cityName): CityBuilder
    {
        $this->cityName = $cityName;
        return $this;
    }

    public function getDistrictName(): string
    {
        return $this->districtName;
    }

    public function setDistrictName(string $districtName): CityBuilder
    {
        $this->districtName = $districtName;
        return $this;
    }

    public function getPopulation(): float
    {
        return $this->population;
    }

    public function setPopulation(float $population): CityBuilder
    {
        $this->population = $population;
        return $this;
    }

    public function getArea(): float
    {
        return $this->area;
    }

    public function setArea(float $area): CityBuilder
    {
        $this->area = $area;
        return $this;
    }

    public function build(): City
    {
        return new City($this);
    }


}
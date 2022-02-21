<?php

namespace App\Facade\City;

use App\Entity\City\City;
use App\Request\DTO\City\CityDto;
use Doctrine\ORM\EntityManagerInterface;

class CityFacade
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function add(CityDto $cityDto): void
    {
        $cities = new City(
            $cityDto->getCityName()
        );

        $this->entityManager->persist($cities);
        $this->entityManager->flush();
    }

}
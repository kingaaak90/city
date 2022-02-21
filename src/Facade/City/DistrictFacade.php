<?php

namespace App\Facade\City;

use App\Entity\City\District;
use App\Entity\City\City;
use App\Repository\City\CityRepository;
use App\Request\DTO\City\DistrictDto;
use Doctrine\ORM\EntityManagerInterface;

class DistrictFacade
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private CityRepository $cityRepository
    )
    {}

    public function add(DistrictDto $districtDto): void
    {
        $city = $this->cityRepository->find($districtDto->getCityId());

        $district = new District(
            $city,
            $districtDto->getDistrictName(),
            $districtDto->getPopulation(),
            $districtDto->getArea()

        );

        $this->entityManager->persist($district);
        $this->entityManager->flush();
    }
}
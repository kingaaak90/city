<?php

namespace App\Repository\City;


use App\Entity\City\City;
use App\Entity\City\District;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method District|null find($id, $lockMode = null, $lockVersion = null)
 * @method District|null findOneBy(array $criteria, array $orderBy = null)
 * @method District[]    findAll()
 * @method District[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DistrictRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, District::class);
    }

    public function getAllDistrictCity(City $city)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.city = :city')
            ->setParameter('city', $city)
            ->getQuery()
            ->getResult();
    }

    public function getDistrictByPopulationDESC(City $city)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.city = :city')
            ->setParameter('city', $city)
            ->orderBy('d.population', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
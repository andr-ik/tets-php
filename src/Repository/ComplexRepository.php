<?php

namespace App\Repository;

use App\Entity\Complex;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Complex|null find($id, $lockMode = null, $lockVersion = null)
 * @method Complex|null findOneBy(array $criteria, array $orderBy = null)
 * @method Complex[]    findAll()
 * @method Complex[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComplexRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Complex::class);
    }
}

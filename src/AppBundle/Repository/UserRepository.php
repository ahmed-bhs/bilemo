<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

/**
 * UserRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Return the list of product with all associated entities.
     *
     * @param User $user
     *
     * @return array|null
     */
    public function findAllWhithAllEntities(User $user): ?array
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.customer', 'c')
            ->addSelect('c')
            ->andWhere('c.name = :customer')
            ->setParameter('customer', $user->getCustomer()->getName())
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Return a user with all associated entities.
     *
     * @param int $value
     *
     * @return User|null
     */
    public function findOneWhithAllEntities(User $user, int $id): ?User
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.customer', 'c')
            ->addSelect('c')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->andWhere('c.name = :customer')
            ->setParameter('customer', $user->getCustomer()->getName())
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

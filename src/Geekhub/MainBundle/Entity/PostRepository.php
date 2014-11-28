<?php

namespace Geekhub\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class PostRepository extends EntityRepository
{

    /**
     * Find last posts
     *
     * @param $count
     * @return array|string
     */
    public function findLatest($count)
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('GeekhubMainBundle:Post', 'p')
            ->orderBy('p.id', 'desc')
            ->setMaxResults($count)
            ->getQuery();
        $result = $query->getResult();
        try {
            if ($result != null) {
                return $result;
            } else {
                throw new NoResultException;
            }
        } catch (NoResultException $e) {
            return $e->getMessage();
        }
    }
}

<?php

namespace Geekhub\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{

    /**
     * Find only enabled tags
     *
     * @return array
     */
    public function findEnabledTags()
    {
        $result = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('t')
            ->from('GeekhubMainBundle:Tag', 't')
            ->where('t.enabled = 1')
            ->orderBy('t.id', 'desc')
            ->setMaxResults(5);

        return $result;
    }
}

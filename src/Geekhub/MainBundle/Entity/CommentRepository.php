<?php

namespace Geekhub\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class CommentRepository extends EntityRepository
{

    /**
     * Find last comments
     *
     * @param $count
     * @return array|string
     */
    public function findLatest($count)
    {
        $query = $this->getEntityManager()->createQuery("SELECT c FROM \\Geekhub\\MainBundle\\Entity\\Comment c ORDER BY c.id DESC");
        $query->setMaxResults($count);
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

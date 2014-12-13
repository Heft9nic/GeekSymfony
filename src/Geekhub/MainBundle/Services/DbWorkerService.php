<?php

namespace Geekhub\MainBundle\Services;

use Doctrine\ORM\EntityManager;

class DbWorkerService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Prepare the given object for saving/removing and commit it to the database
     *
     * @param $obj
     * @param bool $save
     * @return bool
     */
    public function simpleCommit($obj, $save = true)
    {
        $em = $this->getEntityManager();
        $save ? $em->persist($obj) : $em->remove($obj);
        $em->flush();

        return true;
    }
}

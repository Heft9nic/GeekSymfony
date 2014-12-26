<?php

namespace Geekhub\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BaseController extends Controller
{
    /**
     * Save object into database
     *
     * @param $entity
     */
    public function save($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }

    /**
     * Remove object from the database
     *
     * @param $entity
     */
    public function remove($entity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();
    }
}

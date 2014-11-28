<?php

namespace Geekhub\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Table for test ManyToMany self referencing relation in action
 *
 * @ORM\Table(name="geekhub_details")
 * @ORM\Entity
 */
class Detail
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Detail", mappedBy="needFor")
     **/
    private $neededTo;

    /**
     * @ORM\ManyToMany(targetEntity="Detail", inversedBy="neededTo")
     * @ORM\JoinTable(name="details",
     *      joinColumns={@ORM\JoinColumn(name="detail_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="neededTo_detail_id", referencedColumnName="id")}
     *      )
     **/
    private $needFor;

    public function __construct()
    {
        $this->neededTo = new ArrayCollection();
        $this->needFor = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Detail $detail
     * @return $this
     */
    public function addNeededTo(Detail $detail)
    {
        $this->neededTo[] = $detail;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getNeededTo()
    {
        return $this->neededTo;
    }

    /**
     * @param Detail $detail
     * @return $this
     */
    public function addNeedFor(Detail $detail)
    {
        $this->needFor[] = $detail;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getNeedFor()
    {
        return $this->needFor;
    }
}

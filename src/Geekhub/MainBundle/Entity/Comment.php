<?php

namespace Geekhub\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post Entity
 *
 * @ORM\Table(name="geekhub_comments")
 * @ORM\Entity
 */
class Comment
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comment", cascade={"persist"})
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPost()
    {
        return $this->post;
    }
}

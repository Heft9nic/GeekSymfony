<?php

namespace Geekhub\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="geekhub_tags")
 * @ORM\Entity(repositoryClass="Geekhub\MainBundle\Repository\TagRepository")
 */
class Tag
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="tagName", type="string", length=255)
     */
    private $tagName;

    /**
     * @ORM\Column(name="enabled", type="integer", length=4)
     */
    private $enabled = 0;

    /**
     * @Gedmo\Locale
     */
    private $locale;

    /**
     * @ORM\ManyToMany(targetEntity="Post", inversedBy="tags", cascade={"persist"})
     * @ORM\JoinTable(name="posts_tags")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $tagName
     * @return mixed
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post)
    {
        $this->posts->add($post);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @return $this
     */
    public function setEnabled()
    {
        $this->enabled = 1;

        return $this;
    }

    /**
     * @return int
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}

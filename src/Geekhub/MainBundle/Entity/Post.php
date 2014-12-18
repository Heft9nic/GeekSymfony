<?php

namespace Geekhub\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="geekhub_posts")
 * @ORM\Entity(repositoryClass="Geekhub\MainBundle\Repository\PostRepository")
 */
class Post
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Title value should not be blank")
     * @Assert\Length(min=8, minMessage = "This value should be longer than 8 chars")
     */
    private $title;

    /**
     * @ORM\Column(name="content", type="string", length=255)
     * @Assert\NotBlank(message="This value should not be blank")
     * @Assert\Length(min=18, minMessage = "This value should be longer than 18 chars")
     */
    private $content;

    /**
     * @ORM\Column(name="slug_title", type="string", length=255, nullable=true)
     * @Gedmo\Slug(fields={"title"}, updatable=true, separator="_")
     */
    private $slug_title;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */

    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"persist"})
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="posts", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function setComments(Comment $comment)
    {
        $comment->setPost($this);
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param $slug_title
     * @return $this
     */
    public function setSlugTitle($slug_title)
    {
        $this->slug_title = $slug_title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlugTitle()
    {
        return $this->slug_title;
    }
}

<?php

namespace App\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Security\Core\User\UserInterface;
//use Symfony\Component\Security\Core\Security;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
{

    public function __construct()
    {
        $this->created = new \DateTime();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
    */
    private $topic;

    /**
     * @ORM\Column(type="string", length=60)
    */
    private $title;

    /**
     * @ORM\Column(type="text")
    */
    private $body;

    /**
     * @ORM\Column(type="string", length=60)
    */
    private $author;

    /**
     * @ORM\Column(type="text")
    */
    private $image;
    
    /**
     * @ORM\Column(type="datetime")
    */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of topic
     */ 
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of topic
     *
     * @return  self
     */ 
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of created
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set the value of created
     *
     * @return  self
     */ 
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}

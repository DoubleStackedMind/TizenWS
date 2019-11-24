<?php

namespace EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="postid", type="integer")
     */
    private $post;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Set name
     *
     * @param string $title
     *
     * @return Comments
     */
    public function setComment($title)
    {
        $this->comment = $title;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }


    /**
     * Set name
     *
     * @param int $title
     *
     * @return Comments
     */
    public function setPost($title)
    {
        $this->post = $title;

        return $this;
    }

    /**
     * Get name
     *
     * @return integer
     */
    public function getPost()
    {
        return $this->post;
    }
}


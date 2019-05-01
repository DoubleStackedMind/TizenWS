<?php

namespace EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="EntityBundle\Repository\UserRepository")
 */
class User implements Entity
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var /DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", length=255)
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="WorkOut" )
     */
    private $workouts;
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
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set birthdate
     *
     * @param string $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function fromJsonObject($oj)
    {
        $this->fromPostArray(json_decode(html_entity_decode($oj), true));
    }

    public function toJsonObject($fetchType)
    {
        if ($fetchType == "Lazy")
            return array(
                "id" => $this->getId(),
                "name" => $this->getName(),
                "email" => $this->getEmail(),
                "password" => $this->getPassword()

            );
        else if ($fetchType == "Eager") {
            $orders = array();
            $points = array();
            foreach ($this->getOrders() as $order) {
                $orders[] = $order->toJsonObject();
            }
            foreach ($this->getBoughtPoints() as $point) {
                $points[] = $point->toJsonObject();
            }
            return array(
                "id" => $this->getId(),
                "email" => $this->getEmail(),
                "name" => $this->getName(),
                "password" => $this->getPassword(),
                "birthDate" => $this->getBirthDate()->getTimestamp(),

            );
        }
        return "Wrong fetchType";

    }

    public function fromPostArray($pa)
    {
        $date = new \DateTime();
        $date->setTimestamp($pa['birthDate']);
        $this->setId($pa['id']);
        $this->setEmail($pa['email']);
        $this->setBirthDate($date);
        $this->setPassword($pa['password']);
    }
}


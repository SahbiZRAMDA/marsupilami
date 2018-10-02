<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    protected $breed;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    protected $age;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    protected $family;

    /**
     * @ORM\Column(type="array", length=100)
     * @Assert\NotBlank()
     */
    protected $food;

    /**
     * Many Users have many Friends.
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
     */
    protected $myFriends;

    public function __construct()
    {
        parent::__construct();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * @param mixed $breed
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param mixed $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return mixed
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * @param mixed $food
     */
    public function setFood($food)
    {
        $this->food = $food;
    }

    /**
     * @return mixed
     */
    public function getMyFriends()
    {
        return $this->myFriends;
    }

    /**
     * @param mixed $myFriends
     */
    public function setMyFriends($myFriends)
    {
        $this->myFriends = $myFriends;
    }

    /**
     * @param User $friend
     * @return $this
     */
    public function addFriend(User $friend)
    {
        if ($this->myFriends->contains($friend)) {
            return;
        }
        $this->myFriends[] = $friend;
        return $this;
    }

    /**
     * @param User $friend
     * @return bool
     */
    public function removeFriend(User $friend)
    {
        $this->myFriends->removeElement($friend);
        return $this;
    }

    /**
     * @return array
     */
    public function getFriendIds()
    {
        $ids[] = $this->getId();
        foreach ($this->myFriends as $friend) {
            $ids[] = $friend->getId();
        }
        return $ids;
    }
}
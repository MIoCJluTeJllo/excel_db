<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_t_user
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $s_name;
    /**
     * @ORM\Column(type="string")
     */
    private $s_email;

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
    public function getSName()
    {
        return $this->s_name;
    }

    /**
     * @return mixed
     */
    public function getSEmail()
    {
        return $this->s_email;
    }

}
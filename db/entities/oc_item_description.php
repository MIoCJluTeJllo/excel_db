<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_item_description
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="oc_t_item_excel")
     */
    private $pk_i;
    /**
     * @ORM\Column(type="string")
     */
    private $s_title;
    /**
     * @ORM\Column(type="string")
     */
    private $s_description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPkI()
    {
        return $this->pk_i;
    }

    /**
     * @param mixed $pk_i
     */
    public function setPkI($pk_i)
    {
        $this->pk_i = $pk_i;
    }

    /**
     * @return mixed
     */
    public function getSTitle()
    {
        return $this->s_title;
    }

    /**
     * @param mixed $s_title
     */
    public function setSTitle($s_title)
    {
        $this->s_title = $s_title;
    }

    /**
     * @return mixed
     */
    public function getSDescription()
    {
        return $this->s_description;
    }

    /**
     * @param mixed $s_description
     */
    public function setSDescription($s_description)
    {
        $this->s_description = $s_description;
    }
}
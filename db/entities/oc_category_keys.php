<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_category_keys
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $cat_id;
    /**
     * @ORM\Column(type="string")
     */
    private $keys;

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * @param mixed $cat_id
     */
    public function setCatId($cat_id): void
    {
        $this->cat_id = $cat_id;
    }

    /**
     * @return mixed
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * @param mixed $keys
     */
    public function setKeys($keys): void
    {
        $this->keys = $keys;
    }
}
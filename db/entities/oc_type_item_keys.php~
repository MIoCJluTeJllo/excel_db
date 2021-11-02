<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_type_item_keys
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
    private $item_type_id;
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
    public function getItemTypeId()
    {
        return $this->item_type_id;
    }

    /**
     * @param mixed $item_type_id
     */
    public function setItemTypeId($item_type_id): void
    {
        $this->item_type_id = $item_type_id;
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
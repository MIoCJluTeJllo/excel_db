<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class psed_data
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
    private $item_title;
    /**
     * @ORM\Column(type="string")
     */
    private $item_desc;
    /**
     * @ORM\Column(type="integer")
     */
    private $i_price;
    /**
     * @ORM\Column(type="integer")
     */
    private $fk_i_category_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $id_item_class;
    /**
     * @ORM\Column(type="string")
     */
    private $resurs;
    /**
     * @ORM\Column(type="string")
     */
    private $resurs_type;

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
    public function getItemTitle()
    {
        return $this->item_title;
    }

    /**
     * @param mixed $item_title
     */
    public function setItemTitle($item_title)
    {
        $this->item_title = $item_title;
    }

    /**
     * @return mixed
     */
    public function getItemDesc()
    {
        return $this->item_desc;
    }

    /**
     * @param mixed $item_desc
     */
    public function setItemDesc($item_desc)
    {
        $this->item_desc = $item_desc;
    }

    /**
     * @return mixed
     */
    public function getIPrice()
    {
        return $this->i_price;
    }

    /**
     * @param mixed $i_price
     */
    public function setIPrice($i_price)
    {
        $this->i_price = $i_price;
    }

    /**
     * @return mixed
     */
    public function getFkICategoryId()
    {
        return $this->fk_i_category_id;
    }

    /**
     * @param mixed $fk_i_category_id
     */
    public function setFkICategoryId($fk_i_category_id)
    {
        $this->fk_i_category_id = $fk_i_category_id;
    }

    /**
     * @return mixed
     */
    public function getIdItemClass()
    {
        return $this->id_item_class;
    }

    /**
     * @param mixed $id_item_class
     */
    public function setIdItemClass($id_item_class)
    {
        $this->id_item_class = $id_item_class;
    }

    /**
     * @return mixed
     */
    public function getResurs()
    {
        return $this->resurs;
    }

    /**
     * @param mixed $resurs
     */
    public function setResurs($resurs)
    {
        $this->resurs = $resurs;
    }

    /**
     * @return mixed
     */
    public function getResursType()
    {
        return $this->resurs_type;
    }

    /**
     * @param mixed $resurs_type
     */
    public function setResursType($resurs_type)
    {
        $this->resurs_type = $resurs_type;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop) : bool
    {
        return isset($this->$prop);
    }
}
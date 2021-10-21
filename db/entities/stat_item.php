<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class stat_item
{
    public function __construct(){
        $this->setDateAdd(new \DateTime());
    }
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="oc_t_item_excel")
     */
    private $fk_i_item;
    /**
     * @ORM\Column(type="datetime")
     * @ORM\GeneratedValue
     */
    private $date_add;
    /**
     * @ORM\Column(type="string", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $item_title;

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
    public function getFkIItem()
    {
        return $this->fk_i_item;
    }

    /**
     * @param mixed $fk_i_item
     */
    public function setFkIItem($fk_i_item)
    {
        $this->fk_i_item = $fk_i_item;
    }

    /**
     * @return mixed
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param mixed $date_add
     */
    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
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
}
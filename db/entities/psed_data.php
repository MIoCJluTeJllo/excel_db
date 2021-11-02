<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class psed_data
{
    public function __construct($item_title, $item_desc, $i_price, $category, $type, $img_path, $img_type)
    {
        $this->item_title = $item_title;
        $this->item_desc = $item_desc;
        $this->i_price = $i_price;
        $this->category = $category;
        $this->type = $type;
        $this->img_path = $img_path;
        $this->img_type = $img_type;
    }

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
    private $category;
    /**
     * @ORM\Column(type="integer")
     */
    private $type;
    /**
     * @ORM\Column(type="string")
     */
    private $img_path;
    /**
     * @ORM\Column(type="string")
     */
    private $img_type;

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
    public function getItemTitle()
    {
        return $this->item_title;
    }

    /**
     * @return mixed
     */
    public function getItemDesc()
    {
        return $this->item_desc;
    }

    /**
     * @return mixed
     */
    public function getIPrice()
    {
        return $this->i_price;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getImgPath()
    {
        return $this->img_path;
    }

    /**
     * @return mixed
     */
    public function getImgType()
    {
        return $this->img_type;
    }
}
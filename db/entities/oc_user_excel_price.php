<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_user_excel_price
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="oc_t_user")
     */
    private $id_user;
    /**
     * @ORM\Column(type="string")
     */
    private $num_title;
    /**
     * @ORM\Column(type="string")
     */
    private $num_desc;
    /**
     * @ORM\Column(type="integer")
     */
    private $num_price;
    /**
     * @ORM\Column(type="integer")
     */
    private $num_str;

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getNumTitle()
    {
        return $this->num_title;
    }

    /**
     * @param mixed $num_title
     */
    public function setNumTitle($num_title)
    {
        $this->num_title = $num_title;
    }

    /**
     * @return mixed
     */
    public function getNumDesc()
    {
        return $this->num_desc;
    }

    /**
     * @param mixed $num_desc
     */
    public function setNumDesc($num_desc)
    {
        $this->num_desc = $num_desc;
    }

    /**
     * @return mixed
     */
    public function getNumPrice()
    {
        return $this->num_price;
    }

    /**
     * @param mixed $num_price
     */
    public function setNumPrice($num_price)
    {
        $this->num_price = $num_price;
    }

    /**
     * @return mixed
     */
    public function getNumStr()
    {
        return $this->num_str;
    }

    /**
     * @param mixed $num_str
     */
    public function setNumStr($num_str)
    {
        $this->num_str = $num_str;
    }
}
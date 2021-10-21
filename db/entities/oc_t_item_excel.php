<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_t_item_excel
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
    private $fk_i_user;
    /**
     * @ORM\Column(type="string")
     */
    private $s_contact_name;
    /**
     * @ORM\Column(type="string")
     */
    private $s_contact_email;
    /**
     * @ORM\ManyToOne(targetEntity="oc_category_keys", inversedBy="cat_id")
     */
    private $fk_i_category;
    /**
     * @ORM\ManyToOne(targetEntity="oc_type_item_keys", inversedBy="item_type_id")
     */
    private $fk_i_type;
    /**
     * @ORM\Column(type="integer")
     */
    private $i_price;

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
    public function getFkIUser()
    {
        return $this->fk_i_user;
    }

    /**
     * @param mixed $fk_i_user
     */
    public function setFkIUser($fk_i_user)
    {
        $this->fk_i_user = $fk_i_user;
    }

    /**
     * @return mixed
     */
    public function getSContactName()
    {
        return $this->s_contact_name;
    }

    /**
     * @param mixed $s_contact_name
     */
    public function setSContactName($s_contact_name)
    {
        $this->s_contact_name = $s_contact_name;
    }

    /**
     * @return mixed
     */
    public function getSContactEmail()
    {
        return $this->s_contact_email;
    }

    /**
     * @param mixed $s_contact_email
     */
    public function setSContactEmail($s_contact_email)
    {
        $this->s_contact_email = $s_contact_email;
    }

    /**
     * @return mixed
     */
    public function getFkICategory()
    {
        return $this->fk_i_category;
    }

    /**
     * @param mixed $fk_i_category
     */
    public function setFkICategory($fk_i_category)
    {
        $this->fk_i_category = $fk_i_category;
    }

    /**
     * @return mixed
     */
    public function getFkIType()
    {
        return $this->fk_i_type;
    }

    /**
     * @param mixed $fk_i_type
     */
    public function setFkIType($fk_i_type)
    {
        $this->fk_i_type = $fk_i_type;
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
}
<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class oc_t_item_resource
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
    private $fk_i_item;
    /**
     * @ORM\Column(type="string")
     */
    private $s_content_type;
    /**
     * @ORM\Column(type="string")
     */
    private $s_name;
    /**
     * @ORM\Column(type="string")
     */
    private $s_path;

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
    public function getSContentType()
    {
        return $this->s_content_type;
    }

    /**
     * @param mixed $s_content_type
     */
    public function setSContentType($s_content_type)
    {
        $this->s_content_type = $s_content_type;
    }

    /**
     * @return mixed
     */
    public function getSName()
    {
        return $this->s_name;
    }

    /**
     * @param mixed $s_name
     */
    public function setSName($s_name)
    {
        $this->s_name = $s_name;
    }

    /**
     * @return mixed
     */
    public function getSPath()
    {
        return $this->s_path;
    }

    /**
     * @param mixed $s_path
     */
    public function setSPath($s_path)
    {
        $this->s_path = $s_path;
    }
}
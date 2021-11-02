<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * oc_t_type_description
 *
 * @ORM\Table(name="oc_t_type_description", indexes={@ORM\Index(name="cat_id", columns={"cat_id"})})
 * @ORM\Entity
 */
class oc_t_type_description
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="s_name", type="string", length=255, nullable=false)
     */
    private $sName;

    /**
     * @var \oc_t_category_description
     *
     * @ORM\ManyToOne(targetEntity="oc_t_category_description")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cat_id", referencedColumnName="fk_i_category_id")
     * })
     */
    private $cat;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSName(): string
    {
        return $this->sName;
    }
}

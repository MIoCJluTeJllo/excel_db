<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OcTItemResource
 *
 * @ORM\Table(name="oc_t_item_resource", indexes={@ORM\Index(name="fk_i_item_id", columns={"fk_i_item_id"}), @ORM\Index(name="idx_s_content_type", columns={"pk_i_id", "s_content_type"})})
 * @ORM\Entity
 */
class oc_t_item_resource
{
    public function __construct($fkIItem, $sName, $sExtension, $sContentType)
    {
        $this->fkIItem = $fkIItem;
        $this->sName = $sName;
        $this->sExtension = $sExtension;
        $this->sContentType = $sContentType;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="pk_i_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkIId;

    /**
     * @var bool
     *
     * @ORM\Column(name="b_main_img", type="boolean", nullable=false)
     */
    private $bMainImg = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_name", type="string", length=60, nullable=true)
     */
    private $sName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_extension", type="string", length=10, nullable=true)
     */
    private $sExtension;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_content_type", type="string", length=40, nullable=true)
     */
    private $sContentType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_path", type="string", length=250, nullable=true)
     */
    private $sPath = 'oc-content/uploads/222/';

    /**
     * @var \oc_t_item
     *
     * @ORM\ManyToOne(targetEntity="oc_t_item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_i_item_id", referencedColumnName="pk_i_id")
     * })
     */
    private $fkIItem;

    /**
     * @return int
     */
    public function getPkIId(): int
    {
        return $this->pkIId;
    }
}

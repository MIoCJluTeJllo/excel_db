<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OcTItemDescription
 *
 * @ORM\Table(name="oc_t_item_description", indexes={@ORM\Index(name="s_description", columns={"s_description", "s_title"})})
 * @ORM\Entity
 */
class oc_t_item_description
{
    public function __construct($fkIItemId, $sTitle, $sDescription)
    {
        $this->fkIItemId = $fkIItemId;
        $this->sTitle = $sTitle;
        $this->sDescription = $sDescription;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="fk_i_item_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkIItemId;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_c_locale_code", type="string", length=5, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkCLocaleCode = 'ru_RU';

    /**
     * @var string
     *
     * @ORM\Column(name="s_title", type="string", length=100, nullable=false)
     */
    private $sTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="s_description", type="text", length=16777215, nullable=false)
     */
    private $sDescription;

    /**
     * @return int
     */
    public function getFkIItemId(): int
    {
        return $this->fkIItemId;
    }
}

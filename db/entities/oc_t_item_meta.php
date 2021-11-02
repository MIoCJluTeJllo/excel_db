<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OcTItemMeta
 *
 * @ORM\Table(name="oc_t_item_meta", indexes={@ORM\Index(name="s_value", columns={"s_value"}), @ORM\Index(name="fk_i_field_id", columns={"fk_i_field_id"})})
 * @ORM\Entity
 */
class oc_t_item_meta
{
    /**
     * @var int
     *
     * @ORM\Column(name="fk_i_item_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkIItemId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_i_field_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkIFieldId = 5;

    /**
     * @var string
     *
     * @ORM\Column(name="s_multi", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sMulti = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_value", type="text", length=65535, nullable=true)
     */
    private $sValue = 'Оптом';

    /**
     * @param int $fkIItemId
     */
    public function setFkIItemId(int $fkIItemId): void
    {
        $this->fkIItemId = $fkIItemId;
    }
}

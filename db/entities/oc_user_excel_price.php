<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * oc_user_excel_price
 *
 * @ORM\Table(name="oc_user_excel_price", indexes={@ORM\Index(name="id_user_id", columns={"id_user_id"})})
 * @ORM\Entity
 */
class oc_user_excel_price
{
    public function __construct($numTitle, $numDesc, $numPrice, $numStr, $idUser)
    {
        $this->numTitle = $numTitle;
        $this->numDesc = $numDesc;
        $this->numPrice = $numPrice;
        $this->numStr = $numStr;
        $this->idUser = $idUser;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="num_title", type="string", length=255, nullable=false)
     */
    private $numTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="num_desc", type="string", length=255, nullable=false)
     */
    private $numDesc;

    /**
     * @var int
     *
     * @ORM\Column(name="num_price", type="integer", nullable=false)
     */
    private $numPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="num_str", type="integer", nullable=false)
     */
    private $numStr;

    /**
     * @var \oc_t_user
     *
     * @ORM\ManyToOne(targetEntity="oc_t_user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user_id", referencedColumnName="pk_i_id")
     * })
     */
    private $idUser;

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
    public function getNumTitle(): string
    {
        return $this->numTitle;
    }

    /**
     * @return string
     */
    public function getNumDesc(): string
    {
        return $this->numDesc;
    }

    /**
     * @return int
     */
    public function getNumPrice(): int
    {
        return $this->numPrice;
    }

    /**
     * @return int
     */
    public function getNumStr(): int
    {
        return $this->numStr;
    }

    /**
     * @return oc_t_user
     */
    public function getIdUser(): oc_t_user
    {
        return $this->idUser;
    }
}

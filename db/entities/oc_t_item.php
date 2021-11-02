<?php



use Doctrine\ORM\Mapping as ORM;
/**
 * oc_t_item
 *
 * @ORM\Table(name="oc_t_item", indexes={@ORM\Index(name="fk_c_currency_code", columns={"fk_c_currency_code"}), @ORM\Index(name="idx_b_premium", columns={"b_premium"}), @ORM\Index(name="idx_pub_date", columns={"dt_pub_date"}), @ORM\Index(name="idx_s_contact_email", columns={"s_contact_email"}), @ORM\Index(name="idx_price", columns={"i_price"}), @ORM\Index(name="fk_i_category_id", columns={"fk_i_category_id"}), @ORM\Index(name="fk_i_user_id", columns={"fk_i_user_id"})})
 * @ORM\Entity
 */
class oc_t_item
{
    public function __construct($fkIUserId, $sContactName, $sContactEmail, $iPrice, $fkICategoryId, $fkITypeId, $sSecret)
    {
        $this->fkIUserId = $fkIUserId;
        $this->fkICategoryId = $fkICategoryId;
        $this->fkITypeId = $fkITypeId;
        $this->iPrice = $iPrice * 1000000;
        $this->sContactName = $sContactName;
        $this->sContactEmail = $sContactEmail;
        $this->sSecret = $sSecret;
        $now = new \DateTime();
        //$now->setTimezone(new DateTimeZone('Europe/Moscow'));
        $this->dtPubDate = $now;
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
     * @var int|null
     *
     * @ORM\Column(name="fk_i_user_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $fkIUserId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_i_category_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $fkICategoryId;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_i_type_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $fkITypeId;

    /**
     * @var int
     *
     * @ORM\Column(name="i_num_favorites", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $iNumFavorites = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_pub_date", type="datetime", nullable=false)
     */
    private $dtPubDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dt_mod_date", type="datetime", nullable=true)
     */
    private $dtModDate;

    /**
     * @var float|null
     *
     * @ORM\Column(name="f_price", type="float", precision=10, scale=0, nullable=true)
     */
    private $fPrice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="i_price", type="bigint", nullable=true)
     */
    private $iPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="i_last_price", type="bigint", nullable=false)
     */
    private $iLastPrice = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="fk_c_currency_code", type="string", length=3, nullable=true, options={"fixed"=true})
     */
    private $fkCCurrencyCode = 'RUB';

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_contact_name", type="string", length=100, nullable=true)
     */
    private $sContactName;

    /**
     * @var string
     *
     * @ORM\Column(name="s_contact_email", type="string", length=140, nullable=false)
     */
    private $sContactEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="s_ip", type="string", length=64, nullable=false)
     */
    private $sIp = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="b_premium", type="boolean", nullable=false)
     */
    private $bPremium = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="b_enabled", type="boolean", nullable=false, options={"default"="1"})
     */
    private $bEnabled = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="b_active", type="boolean", nullable=false)
     */
    private $bActive = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="b_spam", type="boolean", nullable=false)
     */
    private $bSpam = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_secret", type="string", length=40, nullable=true)
     */
    private $sSecret;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="b_show_email", type="boolean", nullable=true)
     */
    private $bShowEmail = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_expiration", type="string", nullable=false, options={"default"="9999-12-31 23:59:59"})
     */
    private $dtExpiration = "9999-12-31 23:59:59";

    /**
     * @var int
     *
     * @ORM\Column(name="ya_pokazi", type="integer", nullable=false)
     */
    private $yaPokazi = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ya_zvonki", type="integer", nullable=false)
     */
    private $yaZvonki = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="ya_izbranoe", type="integer", nullable=false)
     */
    private $yaIzbranoe = 0;

    /**
     * @return int
     */
    public function getPkIId(): int
    {
        return $this->pkIId;
    }
}

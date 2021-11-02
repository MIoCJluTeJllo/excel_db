<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OcTUser
 *
 * @ORM\Table(name="oc_t_user", uniqueConstraints={@ORM\UniqueConstraint(name="s_email", columns={"s_email"})}, indexes={@ORM\Index(name="fk_i_region_id", columns={"fk_i_region_id"}), @ORM\Index(name="idx_s_name", columns={"s_name"}), @ORM\Index(name="fk_i_city_id", columns={"fk_i_city_id"}), @ORM\Index(name="idx_s_username", columns={"s_username"}), @ORM\Index(name="fk_i_city_area_id", columns={"fk_i_city_area_id"}), @ORM\Index(name="fk_c_country_code", columns={"fk_c_country_code"})})
 * @ORM\Entity
 */
class oc_t_user
{
    /**
     * @var int
     *
     * @ORM\Column(name="pk_i_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkIId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_reg_date", type="datetime", nullable=false)
     */
    private $dtRegDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="dt_mod_date", type="datetime", nullable=true)
     */
    private $dtModDate;

    /**
     * @var string
     *
     * @ORM\Column(name="s_name", type="string", length=100, nullable=false)
     */
    private $sName;

    /**
     * @var string
     *
     * @ORM\Column(name="s_username", type="string", length=100, nullable=false)
     */
    private $sUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="s_email", type="string", length=100, nullable=false)
     */
    private $sEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_website", type="string", length=100, nullable=true)
     */
    private $sWebsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_phone_land", type="string", length=45, nullable=true)
     */
    private $sPhoneLand;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_phone_mobile", type="string", length=45, nullable=true)
     */
    private $sPhoneMobile;

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
    private $bActive = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_pass_code", type="string", length=100, nullable=true)
     */
    private $sPassCode;

    /**
     * @var string
     *
     * @ORM\Column(name="s_reactivation_code", type="string", length=50, nullable=false)
     */
    private $sReactivationCode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="s_pass_date", type="datetime", nullable=true)
     */
    private $sPassDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_pass_ip", type="string", length=15, nullable=true)
     */
    private $sPassIp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fk_c_country_code", type="string", length=2, nullable=true, options={"fixed"=true})
     */
    private $fkCCountryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_country", type="string", length=40, nullable=true)
     */
    private $sCountry;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_address", type="string", length=100, nullable=true)
     */
    private $sAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_zip", type="string", length=15, nullable=true)
     */
    private $sZip;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fk_i_region_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $fkIRegionId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_region", type="string", length=100, nullable=true)
     */
    private $sRegion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fk_i_city_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $fkICityId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_city", type="string", length=100, nullable=true)
     */
    private $sCity;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fk_i_city_area_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $fkICityAreaId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_city_area", type="string", length=200, nullable=true)
     */
    private $sCityArea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="d_coord_lat", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $dCoordLat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="d_coord_long", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $dCoordLong;

    /**
     * @var bool
     *
     * @ORM\Column(name="b_company", type="boolean", nullable=false)
     */
    private $bCompany = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="i_items", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $iItems = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="i_comments", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $iComments = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_access_date", type="datetime", nullable=false, options={"default"="0000-00-00 00:00:00"})
     */
    private $dtAccessDate = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="s_access_ip", type="string", length=15, nullable=false)
     */
    private $sAccessIp = '';

    /**
     * @return int
     */
    public function getPkIId(): int
    {
        return $this->pkIId;
    }

    /**
     * @return DateTime
     */
    public function getDtRegDate(): DateTime
    {
        return $this->dtRegDate;
    }

    /**
     * @return DateTime|null
     */
    public function getDtModDate(): ?DateTime
    {
        return $this->dtModDate;
    }

    /**
     * @return string
     */
    public function getSName(): string
    {
        return $this->sName;
    }

    /**
     * @return string
     */
    public function getSUsername(): string
    {
        return $this->sUsername;
    }

    /**
     * @return string
     */
    public function getSEmail(): string
    {
        return $this->sEmail;
    }

    /**
     * @return string|null
     */
    public function getSWebsite(): ?string
    {
        return $this->sWebsite;
    }

    /**
     * @return string|null
     */
    public function getSPhoneLand(): ?string
    {
        return $this->sPhoneLand;
    }

    /**
     * @return string|null
     */
    public function getSPhoneMobile(): ?string
    {
        return $this->sPhoneMobile;
    }

    /**
     * @return bool
     */
    public function isBEnabled(): bool
    {
        return $this->bEnabled;
    }

    /**
     * @return bool
     */
    public function isBActive()
    {
        return $this->bActive;
    }

    /**
     * @return string|null
     */
    public function getSPassCode(): ?string
    {
        return $this->sPassCode;
    }

    /**
     * @return string
     */
    public function getSReactivationCode(): string
    {
        return $this->sReactivationCode;
    }

    /**
     * @return DateTime|null
     */
    public function getSPassDate(): ?DateTime
    {
        return $this->sPassDate;
    }

    /**
     * @return string|null
     */
    public function getSPassIp(): ?string
    {
        return $this->sPassIp;
    }

    /**
     * @return string|null
     */
    public function getFkCCountryCode(): ?string
    {
        return $this->fkCCountryCode;
    }

    /**
     * @return string|null
     */
    public function getSCountry(): ?string
    {
        return $this->sCountry;
    }

    /**
     * @return string|null
     */
    public function getSAddress(): ?string
    {
        return $this->sAddress;
    }

    /**
     * @return string|null
     */
    public function getSZip(): ?string
    {
        return $this->sZip;
    }

    /**
     * @return int|null
     */
    public function getFkIRegionId(): ?int
    {
        return $this->fkIRegionId;
    }

    /**
     * @return string|null
     */
    public function getSRegion(): ?string
    {
        return $this->sRegion;
    }

    /**
     * @return int|null
     */
    public function getFkICityId(): ?int
    {
        return $this->fkICityId;
    }

    /**
     * @return string|null
     */
    public function getSCity(): ?string
    {
        return $this->sCity;
    }

    /**
     * @return int|null
     */
    public function getFkICityAreaId(): ?int
    {
        return $this->fkICityAreaId;
    }

    /**
     * @return string|null
     */
    public function getSCityArea(): ?string
    {
        return $this->sCityArea;
    }

    /**
     * @return string|null
     */
    public function getDCoordLat(): ?string
    {
        return $this->dCoordLat;
    }

    /**
     * @return string|null
     */
    public function getDCoordLong(): ?string
    {
        return $this->dCoordLong;
    }

    /**
     * @return bool
     */
    public function isBCompany()
    {
        return $this->bCompany;
    }

    /**
     * @return int|null
     */
    public function getIItems()
    {
        return $this->iItems;
    }

    /**
     * @return int|null
     */
    public function getIComments()
    {
        return $this->iComments;
    }

    /**
     * @return DateTime
     */
    public function getDtAccessDate()
    {
        return $this->dtAccessDate;
    }

    /**
     * @return string
     */
    public function getSAccessIp(): string
    {
        return $this->sAccessIp;
    }

    /**
     * @param int|null $iItems
     */
    public function setIItems($iItems): void
    {
        $this->iItems = $iItems;
    }
}

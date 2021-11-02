<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OcTItemLocation
 *
 * @ORM\Table(name="oc_t_item_location", indexes={@ORM\Index(name="fk_i_region_id", columns={"fk_i_region_id"}), @ORM\Index(name="fk_i_city_id", columns={"fk_i_city_id"}), @ORM\Index(name="fk_i_city_area_id", columns={"fk_i_city_area_id"}), @ORM\Index(name="fk_c_country_code", columns={"fk_c_country_code"})})
 * @ORM\Entity
 */
class oc_t_item_location
{
    public function __construct($fkIItemId, $sAddress, $fkIRegionId, $sRegion, $fkICityId, $sCity)
    {
        $this->fkIItemId = $fkIItemId;
        $this->sAddress = $sAddress;
        $this->fkIRegionId = $fkIRegionId;
        $this->sRegion = $sRegion;
        $this->fkICityId = $fkICityId;
        $this->sCity = $sCity;
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
    private $sCountry = '';

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
    private $sCityArea = '';

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


}

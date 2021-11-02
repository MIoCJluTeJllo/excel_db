<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * oc_category
 *
 * @ORM\Table(name="oc_t_category", indexes={@ORM\Index(name="i_position", columns={"i_position"}), @ORM\Index(name="fk_i_parent_id", columns={"fk_i_parent_id"})})
 * @ORM\Entity
 */
class oc_category
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
     * @var int
     *
     * @ORM\Column(name="i_expiration_days", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $iExpirationDays = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="i_position", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $iPosition = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="b_enabled", type="boolean", nullable=false, options={"default"="1"})
     */
    private $bEnabled = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="b_price_enabled", type="boolean", nullable=false, options={"default"="1"})
     */
    private $bPriceEnabled = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_icon", type="string", length=250, nullable=true)
     */
    private $sIcon;

    /**
     * @var \oc_category
     *
     * @ORM\ManyToOne(targetEntity="oc_category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_i_parent_id", referencedColumnName="pk_i_id")
     * })
     */
    private $fkIParent;

    /**
     * @return int
     */
    public function getPkIId(): int
    {
        return $this->pkIId;
    }

    /**
     * @param int $pkIId
     */
    public function setPkIId(int $pkIId): void
    {
        $this->pkIId = $pkIId;
    }

    /**
     * @return int
     */
    public function getIExpirationDays()
    {
        return $this->iExpirationDays;
    }

    /**
     * @param int $iExpirationDays
     */
    public function setIExpirationDays($iExpirationDays): void
    {
        $this->iExpirationDays = $iExpirationDays;
    }

    /**
     * @return int
     */
    public function getIPosition()
    {
        return $this->iPosition;
    }

    /**
     * @param int $iPosition
     */
    public function setIPosition($iPosition): void
    {
        $this->iPosition = $iPosition;
    }

    /**
     * @return bool
     */
    public function isBEnabled(): bool
    {
        return $this->bEnabled;
    }

    /**
     * @param bool $bEnabled
     */
    public function setBEnabled(bool $bEnabled): void
    {
        $this->bEnabled = $bEnabled;
    }

    /**
     * @return bool
     */
    public function isBPriceEnabled(): bool
    {
        return $this->bPriceEnabled;
    }

    /**
     * @param bool $bPriceEnabled
     */
    public function setBPriceEnabled(bool $bPriceEnabled): void
    {
        $this->bPriceEnabled = $bPriceEnabled;
    }

    /**
     * @return string|null
     */
    public function getSIcon(): ?string
    {
        return $this->sIcon;
    }

    /**
     * @param string|null $sIcon
     */
    public function setSIcon(?string $sIcon): void
    {
        $this->sIcon = $sIcon;
    }

    /**
     * @return oc_category
     */
    public function getFkIParent(): ?oc_category
    {
        return $this->fkIParent;
    }

    /**
     * @param oc_category $fkIParent
     */
    public function setFkIParent(oc_category $fkIParent): void
    {
        $this->fkIParent = $fkIParent;
    }
}

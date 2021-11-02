<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * oc_t_category_description
 *
 * @ORM\Table(name="oc_t_category_description", indexes={@ORM\Index(name="idx_s_slug", columns={"s_slug"}), @ORM\Index(name="fk_c_locale_code", columns={"fk_c_locale_code"})})
 * @ORM\Entity
 */
class oc_t_category_description
{
    /**
     * @var int
     *
     * @ORM\Column(name="fk_i_category_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fkICategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_c_locale_code", type="string", length=5, nullable=false, options={"fixed"=true})
     */
    private $fkCLocaleCode = 'ru_RU';

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_name", type="string", length=100, nullable=true)
     */
    private $sName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="s_description", type="text", length=65535, nullable=true)
     */
    private $sDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="s_slug", type="string", length=255, nullable=false)
     */
    private $sSlug;

    /**
     * @return int
     */
    public function getFkICategoryId(): int
    {
        return $this->fkICategoryId;
    }

    /**
     * @param int $fkICategoryId
     */
    public function setFkICategoryId(int $fkICategoryId): void
    {
        $this->fkICategoryId = $fkICategoryId;
    }

    /**
     * @return string
     */
    public function getFkCLocaleCode(): string
    {
        return $this->fkCLocaleCode;
    }

    /**
     * @param string $fkCLocaleCode
     */
    public function setFkCLocaleCode(string $fkCLocaleCode): void
    {
        $this->fkCLocaleCode = $fkCLocaleCode;
    }

    /**
     * @return string|null
     */
    public function getSName(): ?string
    {
        return $this->sName;
    }

    /**
     * @param string|null $sName
     */
    public function setSName(?string $sName): void
    {
        $this->sName = $sName;
    }

    /**
     * @return string|null
     */
    public function getSDescription(): ?string
    {
        return $this->sDescription;
    }

    /**
     * @param string|null $sDescription
     */
    public function setSDescription(?string $sDescription): void
    {
        $this->sDescription = $sDescription;
    }

    /**
     * @return string
     */
    public function getSSlug(): string
    {
        return $this->sSlug;
    }

    /**
     * @param string $sSlug
     */
    public function setSSlug(string $sSlug): void
    {
        $this->sSlug = $sSlug;
    }
}

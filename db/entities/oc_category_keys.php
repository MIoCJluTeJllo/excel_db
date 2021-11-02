<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * OcCategoryKeys
 *
 * @ORM\Table(name="oc_category_keys")
 * @ORM\Entity
 */
class oc_category_keys
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="keys", type="string", length=255, nullable=false)
     */
    private $keys;

    /**
     * @return int
     */
    public function getCatId(): int
    {
        return $this->catId;
    }

    /**
     * @return string
     */
    public function getKeys(): string
    {
        return $this->keys;
    }
}

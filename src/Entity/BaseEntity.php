<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class BaseEntity
 * @package App\Entity
 * @ApiFilter(DateFilter::class,properties={"createdAt"})
 */
class BaseEntity
{
    /**
     * BaseEntity constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamp(): void
    {
        $this->updatedAt  = new \DateTime('now');
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"GetBase", "GetObjBase","GetId","PushRedis"})
     */
    public $id;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @Groups({"GetBase", "GetObjBase"})
     */
    public $createdAt;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @Groups({"GetBase", "GetObjBase"})
     */
    public $updatedAt;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"GetBase", "GetObjBase"})
     */
    public $deleted_at;

}

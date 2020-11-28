<?php


namespace App\Entity\Offer;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Offer\Offer;
use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    OrderFilter,
    NumericFilter,
    DateFilter,
    SearchFilter
};

/**
 * @ApiResource(
 *     description="Настройки Заявки",
 *     collectionOperations={
 *          "get",
 *          "post"
 *     },
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete"
 *     },
 *    cacheHeaders={"max_age"=60, "shared_max_age"=120, "vary"={"Authorization","authorization","Accept-Language"}}
 * )
 * @ORM\Entity()
 * @ApiFilter(NumericFilter::class, properties={"id", "author.id"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "comment"="partial",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class Solution extends BaseEntity
{

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @Groups({"GetSolution","GetObjSolution", "SetSolution"})
     */
    public $author;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Groups({"GetSolution","GetObjSolution", "SetSolution"})
     */
    public string $comment;

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @Groups({"GetSolution","GetObjSolution", "SetSolution"})
     */
    public int $newOfferStatus = Offer::STATUS_PENDING;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="solutions")
     * @Groups({"GetSolution","GetObjSolution", "SetSolution"})
     */
    public $offer;
}

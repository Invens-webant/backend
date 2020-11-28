<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    OrderFilter,
    DateFilter,
    SearchFilter,
    NumericFilter
};
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Offer\Offer;

/**
 * @ApiResource(
 *     description="Comment - Комметарий к заявке",
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
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "title"="partial",
 *     "author"="partial",
 *     "text"="partial",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class Comment extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @Groups({"GetComment","GetObjComment", "SetComment"})
     */
    public $author;

    /**
     * @ORM\Column(type="string")
     * @Groups({"GetComment","GetObjComment", "SetComment"})
     */
    public string $text;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"GetComment","GetObjComment", "SetComment"})
     */
    public float $rating;

    /**
     * @ORM\ManyToOne(targetEntity=Offer::class, inversedBy="comments")
     * @ORM\JoinColumn(referencedColumnName="id")
     * @Groups({"GetComment","GetObjComment", "SetComment"})
     */
    public $offer;
}
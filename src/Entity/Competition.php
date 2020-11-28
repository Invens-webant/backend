<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    NumericFilter,
    SearchFilter,
    DateFilter,
    OrderFilter,
};
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Offer\Offer;
use App\Entity\User;

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
class Competition extends BaseEntity
{
    public function __construct()
    {
        parent::__construct();
        $this->offers = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string")
     * @Groups({"GetCompetition","GetObjCompetition", "SetCompetition"})
     */
    public string $name;

    /**
     * @ORM\ManyToMany (targetEntity=Offer::class)
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $offers;

    /**
     * @ORM\ManyToMany(targetEntity=User::class)
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $experts;
}
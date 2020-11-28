<?php


namespace App\Entity\Offer;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;
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
 * @ApiFilter(NumericFilter::class, properties={
 *     "id",
 *     "economicEffect",
 *     "remunerationType",
 *     "implementationCost",
 *     "remunerationCost",
 *     "id",
 * })
 * @ApiFilter(SearchFilter::class, properties={
 *     "remunerationType",
 *     "paymentImplementationDocumentDetails",
 *     "paymentRemunerationDocumentForReplicationDetails",
 *     "note",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class OfferResult extends BaseEntity
{
    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public float $economicEffect;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public string $remunerationType;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public string $paymentImplementationDocumentDetails;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public float $implementationCost;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public string $paymentRemunerationDocumentForReplicationDetails;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public float $remunerationCost;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"GetOfferResult","GetObjOfferResult", "SetOfferResult"})
     */
    public string $note;
}
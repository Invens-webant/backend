<?php


namespace App\Entity\Mail;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    OrderFilter,
    NumericFilter,
    DateFilter,
    SearchFilter
};
use App\Entity\Offer\OfferSettings;
use App\Entity\User;

/**
 * @ApiResource(
 *     description="Сформированное письмо эксперту",
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
 * @ApiFilter(NumericFilter::class, properties={"status","id"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "title"="partial",
 *     "category"="partial",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class ExpertMail extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    public $expert;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    public string $text;


    /**
     * @ORM\ManyToOne(targetEntity=OfferSettings::class, inversedBy="mails")
     */
    public $offer;
}
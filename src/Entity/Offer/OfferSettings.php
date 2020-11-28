<?php


namespace App\Entity\Offer;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Mail\ExpertMail;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    NumericFilter,
    OrderFilter,
    DateFilter,
    SearchFilter,
};
use App\Entity\User;
use App\Entity\MediaObject;
use Symfony\Component\Validator\Constraints as Assert;

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
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "title"="partial",
 *     "category"="partial",
 *     "responseAddress"="partial",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 *     "dateStart",
 *     "dateEnd",
 *     "dateTestStart",
 *     "dateTestEnd",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class OfferSettings extends BaseEntity
{
    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public DateTime $dateStart;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public DateTime $dateEnd;
    /**
     * @ORM\ManyToMany(targetEntity=User::class)
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public $experts; // users

    /**
     * @var
     * @ORM\OneToMany(targetEntity=ExpertMail::class, mappedBy="offer")
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public $mails; // при смене статуса отправлются эксперку

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public string  $responseAddress; // обратный аддресс

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public DateTime $dateTestStart; // Даты тестирования

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
     */
    public DateTime $dateTestEnd;

//    /**
//     * @var MediaObject|null
//     *
//     * @ORM\ManyToOne(targetEntity=MediaObject::class)
//     * @ORM\JoinColumn(nullable=true)
//     * @ApiProperty(iri="http://schema.org/image")
//     * @Groups({"GetOfferSetiings","GetObjOfferSetiings", "SetOfferSetiings"})
//     */
//    public $protocols; // список протоколов экспертов

    /**
     * @var int
     * @ORM\Column(type="integer")
     * @Assert\Range(min="0", max="10")
     */
    public int $priority;

    public function addMail(ExpertMail $mail)
    {
        if ($this->mails->contains($mail)) {
            return;
        }
        $this->mails[]  = $mail;
    }

    public function removeStudiedGenus(ExpertMail $mail)
    {
        $this->mails->removeElement($mail);
    }


    public function addExpert(User $user)
    {
        if ($this->mails->contains($user)) {
            return;
        }
        $this->experts[]  = $user;
    }

    public function removeExpert(User $user)
    {
        $this->mails->removeElement($user);
    }

}
<?php


namespace App\Entity\Offer;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseEntity;
use App\Entity\MediaObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Comment;

use Doctrine\ORM\Mapping\JoinColumn;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    OrderFilter,
    NumericFilter,
    DateFilter,
    SearchFilter
};
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Offer\Solution;
use App\Entity\Offer\OfferSettings;
use App\Entity\Offer\OfferResult;
use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\Offer\GetSimilarOffers;

/**
 * @ApiResource(
 *     description="Offer - Заявка",
 *     collectionOperations={
 *          "get",
 *          "post",
 *     },
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "getSimilar":{
 *              "method": "GET",
 *              "controller": GetSimilarOffers::class,
 *              "path": "/offers/{id}/similar"
 *           }
 *     },
 *     attributes={
 *        "normalization_context"={"groups"={"GetOffer","GetObjOffer", "GetObjBase"}},
 *        "denormalization_context"={"groups"={"SetOffer"}},
 *     },
 *    cacheHeaders={"max_age"=60, "shared_max_age"=120, "vary"={"Authorization","authorization","Accept-Language"}}
 * )
 * @ORM\Entity()
 * @ORM\Table(name="offers")
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
class Offer extends BaseEntity
{
    
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_TEST = 2;
    const STATUS_TIRAGE = 3;
    const STATUS_EDIT = 6;

    const STATUS_FULL_CANCEL = 5;
    const STATUS_FULL_ACCEPT = 4;


    public function __construct()
    {
        parent::__construct();

        $this->comments = new ArrayCollection();
        $this->solutions = new ArrayCollection();

        $this->documents = new ArrayCollection();
        $this->files = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public int $status = self::STATUS_PENDING;

    /**
     * @ORM\Column(type="text")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $currentSolution;

    /**
     * @ORM\Column(type="string")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $category;

    /**
     * @ORM\Column(type="text")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $proposedSolution;

    /**
     * @ORM\Column(type="text")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $expectedResult;

    /**
     * @ORM\Column(type="float")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public float $rating;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class ,mappedBy="offer")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $comments;

    /**
     * @ORM\ManyToMany(targetEntity=MediaObject::class)
     * @ORM\JoinTable(name="offer_file")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $files;

    /**
     * @ORM\ManyToMany(targetEntity=MediaObject::class)
     * @ORM\JoinTable(name="offer_document")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $documents;

    /**
     * @var MediaObject|null
     *
     * @ORM\OneToOne(targetEntity=OfferSettings::class)
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $settings;

    /**
     * @ORM\OneToMany(targetEntity=Solution::class ,mappedBy="offer")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $solutions;

    /**
     * @var ArrayCollection
     * @ORM\Column(type="json")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $coAuthors;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity=User::class)
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $author;

    /**
     * @var string
     * @ORM\Column(type="json")
     * @Assert\NotBlank()
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $costs;

    /**
     * @var string
     * @ORM\Column(type="json")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public string $timing;

    /**
     * @var bool
     * @ORM\Column(type="boolean",options={"default": 0})
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public bool $isImplemented = false;

    /**
     * @ORM\OneToOne(targetEntity=OfferResult::class)
     * @JoinColumn(name="result_id", referencedColumnName="id")
     * @Groups({"GetOffer","GetObjOffer", "SetOffer"})
     */
    public $result;

    public function addFile(MediaObject $mediaObject)
    {
        if ($this->files->contains($mediaObject)) {
            return;
        }
        $this->files[] = $mediaObject;
    }

    public function removeFile(MediaObject $mediaObject)
    {
        $this->files->removeElement($mediaObject);
    }

    public function addDocument(MediaObject $mediaObject)
    {
        if ($this->documents->contains($mediaObject)) {
            return;
        }
        $this->documents[] = $mediaObject;
    }

    public function removeDocument(MediaObject $mediaObject)
    {
        $this->documents->removeElement($mediaObject);
    }

}

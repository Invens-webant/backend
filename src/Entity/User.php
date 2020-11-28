<?php


namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\{
    OrderFilter,
    DateFilter,
    SearchFilter,
    NumericFilter
};
use Symfony\Component\Validator\Constraints as Assert;

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
 * @ORM\Table(name="ros_user")
 * @ApiFilter(NumericFilter::class, properties={"id"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "name"="partial",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class User
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    public string $name;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     * @Assert\Email()
     */
    public string $email;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    public string $fio;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    public string $jobTitle;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    public int $role = 0;

}
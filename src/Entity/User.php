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
 *     "name"="partial",
 * })
 * @ApiFilter(DateFilter::class, properties={
 *     "createdAt",
 * })
 * @ApiFilter(OrderFilter::class)
 */
class User extends BaseEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    public string $name;

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

}
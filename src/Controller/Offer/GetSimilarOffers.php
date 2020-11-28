<?php


namespace App\Controller\Offer;


use App\Entity\Offer\Offer;
use App\Service\OfferService;
use Doctrine\ORM\EntityManagerInterface;

class GetSimilarOffers
{
    private $em;
    private $offerService;

    public function __construct(EntityManagerInterface $em, OfferService $offerService)
    {
        $this->em = $em;
        $this->offerService = $offerService;
    }

    public function __invoke(Offer $data)
    {
        return $this->em->getRepository(Offer::class)
            ->findBy(['id' => $this->offerService->getSimilarOffer($data)]);
    }

}
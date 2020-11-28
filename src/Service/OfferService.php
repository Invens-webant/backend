<?php


namespace App\Service;


use App\Entity\Offer\Offer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OfferService
{

    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getSimilarOffer(Offer $offer): array{
        $response = $this->httpClient->request('POST', 'http://similar:8081/q', [
            'json' => [
                'id' => $offer->id,
                'expected_result' => $offer->expectedResult,
                'proposed_solution' => $offer->proposedSolution,
            ]
        ]);

        $offers = json_decode($response->getContent(), true);
        $offersIds = [];

        foreach ($offers as $o) {
            $offersIds[] = $o['id'];
        }

        return $offersIds;
    }
}
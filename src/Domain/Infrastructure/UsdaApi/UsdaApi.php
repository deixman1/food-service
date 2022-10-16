<?php

declare(strict_types=1);

namespace App\Domain\Infrastructure\UsdaApi;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;

class UsdaApi
{
    private const BASE_URL = "https://api.nal.usda.gov/fdc/v1/foods/search";

    public function __construct(
        private readonly ClientInterface $guzzleClient,
        private readonly string $key,
    ) {}

    /**
     * @param string $query
     * @return array
     * @throws GuzzleException
     */
    public function searchFoodDataByQuery(string $query): array
    {
        $response = $this->guzzleClient->request(
            'POST',
            self::BASE_URL . '?api_key=' . $this->key,
            [
                'json' => [
                    'query' => $query,
                    'pageSize' => 1,
                ],
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
    }
}
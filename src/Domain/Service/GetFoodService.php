<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Infrastructure\UsdaApi\UsdaApi;
use App\Domain\Model\Food;
use GuzzleHttp\Exception\GuzzleException;

class GetFoodService
{
    private UsdaApi $usdaApi;

    public function __construct(UsdaApi $usdaApi)
    {
        $this->usdaApi = $usdaApi;
    }

    /**
     * @param string $query
     * @return array
     * @throws GuzzleException
     */
    public function searchFoodDataByQuery(string $query): array
    {
        $foodsData = $this->usdaApi->searchFoodDataByQuery($query)['foods'] ?? [];
        $foods = [];
        foreach ($foodsData as $foodData) {
            $kcalValue = 0;
            foreach ($foodData['foodNutrients'] as $foodNutrients) {
                if ($foodNutrients['unitName'] === 'KCAL') {
                    $kcalValue = isset($foodNutrients['value']) ? (int)$foodNutrients['value'] : 0;
                    break;
                }
            }
            $food = new Food(
                id: isset($foodData['fdcId']) ? (string)$foodData['fdcId'] : null,
                name: isset($foodData['lowercaseDescription']) ? (string)$foodData['lowercaseDescription'] : null,
                calories: $kcalValue,
            );
            $foods[] = $food;
        }
        return $foods;
    }
}
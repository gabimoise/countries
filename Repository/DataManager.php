<?php
declare(strict_types=1);

namespace Yas\Repository;

use Yas\Dto\CountryDto;
use Yas\Dto\LanguageDto;
use Yas\Repository\DataProvider\DataProviderInterface;

class DataManager
{
    private $dataProvider;

    /**
     * DataManager constructor.
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param string $name
     * @return CountryDto
     */
    public function getCountry(string $name): CountryDto
    {
        $countries = $this->dataProvider->getCountryByName($name);
        return $this->buildCountryDto($countries[0]);
    }

    /**
     * @param string $languageCode
     * @return array
     */
    public function getCountriesByCode(string $languageCode): array
    {
        $countries = $this->dataProvider->getCountriesByLanguageCode($languageCode);
        $result = [];
        foreach ($countries as $country) {
            $result[] = $this->buildCountryDto($country);
        }
        return $result;
    }

    /**
     * @param $country
     * @return CountryDto
     */
    private function buildCountryDto($country): CountryDto
    {
        $countryDto = new CountryDto();
        $countryDto->setName($country['name']);
        foreach ($country['languages'] as $item) {
            $language = new LanguageDto();
            $language->setName($item['name']);
            $language->setCode($item['iso639_1']);
            $countryDto->addLanguage($language);
        }

        return $countryDto;
    }
}
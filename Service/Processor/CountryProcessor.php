<?php
declare(strict_types=1);

namespace Yas\Service\Processor;

use Yas\Dto\CountryDto;
use Yas\Repository\DataManager;

class CountryProcessor implements ProcessorInterface
{

    /** @var string */
    protected $country;

    /** @var DataManager */
    protected $dataManager;

    public function __construct(string $country)
    {
        $this->country = $country;
    }

    public function process(): string
    {
        $countryDto = $this->dataManager->getCountry($this->country);
        $code = $countryDto->getLanguageCode();
        $countriesByLanguageCode = $this->dataManager->getCountriesByCode($code);
        return sprintf(
            'Country language code: %s. %s%s speaks same language with these countries: %s.',
            $code,
            PHP_EOL,
            $this->country,
            implode(', ', $this->getCountryNames($countriesByLanguageCode))
        );
    }

    public function setDataManager(DataManager $dataManager): ProcessorInterface
    {
        $this->dataManager = $dataManager;
        return $this;
    }

    /**
     * @param array $countries
     * @return array
     */
    private function getCountryNames(array $countries): array
    {
        $result = [];
        /** @var CountryDto $country */
        foreach ($countries as $country) {
            if ($country->getName() === $this->country) {
                continue;
            }
            $result[] = $country->getName();
        }

        return $result;
    }
}
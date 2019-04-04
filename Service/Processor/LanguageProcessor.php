<?php
declare(strict_types=1);

namespace Yas\Service\Processor;

use Yas\Dto\CountryDto;
use Yas\Repository\DataManager;

class LanguageProcessor implements ProcessorInterface
{
    private $dataManager;

    /** @var string */
    private $country1;

    /** @var string */
    private $country2;

    public function __construct(string $country1, string $country2)
    {
        $this->country1 = $country1;
        $this->country2 = $country2;
    }

    public function process(): string
    {
        $country1Dto = $this->dataManager->getCountry($this->country1);
        $countryD2to = $this->dataManager->getCountry($this->country2);

        $intersect = array_intersect(
            $this->getLanguagesCodes($country1Dto),
            $this->getLanguagesCodes($countryD2to)
        );
        if (!\count($intersect)) {
            return sprintf('%s and %s do not speak the same language', $this->country1, $this->country2);
        }
        return sprintf('%s and %s speak the same language', $this->country1, $this->country2);

    }

    public function setDataManager(DataManager $dataManager): ProcessorInterface
    {
        $this->dataManager = $dataManager;
        return $this;
    }

    private function getLanguagesCodes(CountryDto $countryDto): array
    {
        $languages = [];
        foreach ($countryDto->getLanguages() as $language)
        {
            $languages[] = $language->getCode();
        }
        return $languages;
    }
}
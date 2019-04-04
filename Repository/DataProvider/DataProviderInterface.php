<?php
declare(strict_types=1);

namespace Yas\Repository\DataProvider;

/**
 * Interface DataProviderInterface
 * @package Yas\Repository
 */
interface DataProviderInterface
{
    /**
     * @param string $name
     * @return array
     */
    public function getCountryByName(string $name): array;

    /**
     * @param string $languageCode
     * @return array
     */
    public function getCountriesByLanguageCode(string $languageCode): array;
}
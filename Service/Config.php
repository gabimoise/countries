<?php
declare(strict_types=1);

namespace Yas\Service;

use Yas\Repository\DataProvider\ApiDataProvider;
use Yas\Repository\DataProvider\DataProviderInterface;

/**
 * Class Config
 *
 * This class is used to define the services used (e.g.: services.yaml in Symfony)
 *
 *
 * @package Yas\Service
 */
class Config
{

    /**
     * Configure which data provider to use. Now is an API, in future it may be MySQL
     * @return DataProviderInterface
     */
    public static function getDataProvider(): DataProviderInterface
    {
        return new ApiDataProvider('https://restcountries.eu/rest/v2/');
    }
}
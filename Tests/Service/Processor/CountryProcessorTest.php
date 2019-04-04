<?php
declare(strict_types=1);

namespace Yas\Tests;

$autoloader = require __DIR__ . '/../../../vendor/autoload.php';
$autoloader->addPsr4('Yas\\', __DIR__ . '/../../../');

use PHPUnit\Framework\TestCase;
use Yas\Dto\CountryDto;
use Yas\Dto\LanguageDto;
use Yas\Repository\DataManager;
use Yas\Service\Processor\CountryProcessor;

class CountryProcessorTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProviderProcess(): array
    {
        $countryDto = new CountryDto();
        $countryDto->setName('Spain');
        $language = new LanguageDto();
        $language->setName('Spanish')
            ->setCode('es');
        $countryDto->addLanguage($language);

        $country2Dto = new CountryDto();
        $country2Dto->setName('Mexic');
        $language = new LanguageDto();
        $language->setName('Spanish')
            ->setCode('es');

        return [
            [
                'Spain',
                $countryDto,
                [$countryDto, $country2Dto]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderProcess
     * @param $countryName
     * @param $country
     * @param $countriesByCodes
     * @throws \ReflectionException
     */
    public function testProcess(string $countryName, CountryDto $countryDto, array $countriesByCodes)
    {
        $dataManager = $this->getMockBuilder(DataManager::class)
            ->disableOriginalConstructor()
            ->setMethods(['getCountry', 'getCountriesByCode'])
            ->getMock();

        $dataManager->expects($this->once())
            ->method('getCountry')
            ->willReturn($countryDto);

        $dataManager->expects($this->once())
            ->method('getCountriesByCode')
            ->willReturn($countriesByCodes);

        $service = new CountryProcessor($countryName);
        $service->setDataManager($dataManager);
        $result = $service->process();
        $this->assertIsString($result);
    }
}

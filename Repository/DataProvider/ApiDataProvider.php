<?php
declare(strict_types=1);

namespace Yas\Repository\DataProvider;

/**
 * Class ApiDataProvider
 *
 * @package Yas\Repository\DataProvider
 */
class ApiDataProvider implements DataProviderInterface
{
    protected const COUNTRY_URL = 'name/%s?fullText=true';

    protected const LANGUAGE_URL = 'lang/%s';

    /** @var string */
    protected $baseUrl;

    /**
     * ApiDataProvider constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param string $url
     * @return bool|string
     */
    private function getData(string $url): string
    {
        $ch = curl_init($this->baseUrl . $url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $error    = curl_error($ch);
        $errNumber    = curl_errno($ch);

        if (is_resource($ch)) {
            curl_close($ch);
        }

        if (0 !== $errNumber) {
            throw new \RuntimeException($error, $errNumber);
        }

        return $result;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getCountryByName(string $name): array
    {
        $result = $this->decodeData(
            $this->getData(sprintf(static::COUNTRY_URL, $name))
        );

        if (isset($result['status']) && $result['status'] === 404) {
            throw new \RuntimeException(
                sprintf('There is no country named %s.', $name)
            );
        }

        return $result;
    }

    /**
     * @param string $languageCode
     * @return array
     */
    public function getCountriesByLanguageCode(string $languageCode): array
    {

        $result = $this->decodeData(
            $this->getData(sprintf(static::LANGUAGE_URL, $languageCode))
        );

        if (isset($result['status']) && $result['status'] === 404) {
            throw new \RuntimeException(
                sprintf('There is no country named %s.', $languageCode)
            );
        }

        return $result;
    }

    /**
     * @param string $data
     * @return array
     */
    private function decodeData(string $data): array
    {
        $result = \json_decode($data, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(
                sprintf('Could not decode response: %s.', $result)
            );
        }

        return $result;
    }
}

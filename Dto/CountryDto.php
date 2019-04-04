<?php
declare(strict_types=1);

namespace Yas\Dto;

/**
 * Class CountryDto
 * @package Yas\Dto
 */
class CountryDto
{
    /** @var string */
    private $name;

    /** @var array | LanguageDto[] */
    private $languages = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CountryDto
     */
    public function setName(string $name): CountryDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array|LanguageDto[]
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param array|LanguageDto[] $languages
     * @return CountryDto
     */
    public function setLanguages($languages): CountryDto
    {
        $this->languages = $languages;
        return $this;
    }

    /**
     * @param LanguageDto $language
     * @return CountryDto
     */
    public function addLanguage(LanguageDto $language): CountryDto
    {
        if (!$this->containsLanguage($language)) {
            $this->languages[] = $language;
        }

        return $this;
    }

    /**
     * @param LanguageDto $languageDto
     * @return bool
     */
    public function containsLanguage(LanguageDto $languageDto): bool
    {
        foreach ($this->languages as $language) {
            if ($language->getCode() === $languageDto->getCode()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        if (!\count($this->languages)) {
            throw new \LogicException('Country has no languate?!');
        }

        return reset($this->languages)->getCode();
    }
}
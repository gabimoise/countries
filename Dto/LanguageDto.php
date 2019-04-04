<?php
declare(strict_types=1);

namespace Yas\Dto;

class LanguageDto
{
    /** @var string */
    private $code;

    /** @var string */
    private $name;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return LanguageDto
     */
    public function setCode(string $code): LanguageDto
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return LanguageDto
     */
    public function setName(string $name): LanguageDto
    {
        $this->name = $name;
        return $this;
    }
}

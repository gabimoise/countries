<?php
declare(strict_types=1);

namespace Yas\Service;

use Yas\Service\Processor\CountryProcessor;
use Yas\Service\Processor\LanguageProcessor;
use Yas\Service\Processor\ProcessorInterface;

class ProcessorFactory
{
    /**
     * @param array $argv
     * @return ProcessorInterface
     */
    public static function getProcessor(array $argv): ProcessorInterface
    {
        switch (\count($argv)) {
            case 2:
                return new CountryProcessor($argv[1]);
                    break;
            case 3:
                return new LanguageProcessor($argv[1], $argv[2]);

            default:
                throw new \RuntimeException('Invalid number of arguments received');
        }
    }
}

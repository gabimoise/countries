<?php
declare(strict_types=1);

namespace Yas\Service\Processor;

use Yas\Repository\DataManager;

interface ProcessorInterface
{
    public function process(): string;

    public function setDataManager(DataManager $dataManager): ProcessorInterface;
}
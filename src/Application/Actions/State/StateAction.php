<?php
declare(strict_types=1);

namespace App\Application\Actions\State;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\State\PostgreStateRepository;
use Psr\Log\LoggerInterface;

abstract class StateAction extends Action
{
    protected PostgreStateRepository $stateRepository;

    public function __construct(LoggerInterface $logger, PostgreStateRepository $stateRepository)
    {
        parent::__construct($logger);
        $this->stateRepository = $stateRepository;
    }
}

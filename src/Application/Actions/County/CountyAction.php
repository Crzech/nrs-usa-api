<?php
declare(strict_types=1);

namespace App\Application\Actions\County;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\County\PostgresCountiesRepository;
use Psr\Log\LoggerInterface;

abstract class CountyAction extends Action
{
    protected PostgresCountiesRepository $countyRepository;

    public function __construct(LoggerInterface $logger, PostgresCountiesRepository $countyRepository)
    {
        parent::__construct($logger);
        $this->countyRepository = $countyRepository;
    }
}

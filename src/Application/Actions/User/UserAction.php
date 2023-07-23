<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\User\PostgresUserRepository;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action
{
    protected PostgresUserRepository $userRepository;

    public function __construct(LoggerInterface $logger, PostgresUserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }
}

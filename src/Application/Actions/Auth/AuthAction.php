<?php
declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\User\PostgresUserRepository;
use Psr\Log\LoggerInterface;

abstract class AuthAction  extends Action{
    protected PostgresUserRepository $userRepository;

    public function __construct(LoggerInterface $logger, PostgresUserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }
}
?>

<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class NotUniqueUserException extends DomainRecordNotFoundException
{
    public $message = 'Username should be unique';
}

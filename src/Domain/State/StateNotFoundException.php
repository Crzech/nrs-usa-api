<?php

declare(strict_types=1);

namespace App\Domain\State;

use App\Domain\DomainException\DomainRecordNotFoundException;

class StateNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The state you requested does not exist.';
}

<?php

declare(strict_types=1);

namespace App\Domain\County;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CountyNotValidStateException extends DomainRecordNotFoundException
{
    public $message = 'The state specified for this county doesn\'t exist in our database.';
}

<?php

declare(strict_types=1);

namespace App\Domain\County;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CountyNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The county you asked doesn\'t exist in our database.';
}

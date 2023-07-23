<?php

declare(strict_types=1);

namespace App\Application\Actions\State;

use Psr\Http\Message\ResponseInterface as Response;


class ListCountiesByStateAction extends StateAction
{
    protected function action(): Response
    {
        $states = $this->stateRepository->getCounties((int) $this->resolveArg('id'));
        $this->logger->info("State list was viewed");
        return $this->respondWithData($states);
    }
}

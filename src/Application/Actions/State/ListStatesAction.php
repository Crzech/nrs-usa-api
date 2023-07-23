<?php

declare(strict_types=1);

namespace App\Application\Actions\State;

use Psr\Http\Message\ResponseInterface as Response;


class ListStatesAction extends StateAction
{
    protected function action(): Response
    {
        $states = $this->stateRepository->findAll();
        $this->logger->info("State list was viewed");
        return $this->respondWithData($states);
    }
}

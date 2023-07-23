<?php

declare(strict_types=1);

namespace App\Application\Actions\County;

use App\Domain\County\CountyNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;


class FindCountyByIdAction extends CountyAction
{
    protected function action(): Response
    {
        try {
            $county = $this->countyRepository->findById((int) $this->resolveArg('county_id'));
            return $this->respondWithData($county);
        } catch (CountyNotFoundException $err) {
            return $this->respondWithData(["error" => $err->getMessage()], 400);
        }

    }
}

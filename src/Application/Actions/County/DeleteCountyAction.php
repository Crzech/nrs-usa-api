<?php

declare(strict_types=1);

namespace App\Application\Actions\County;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteCountyAction extends CountyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id = $this->resolveArg('county_id');
        $this->countyRepository->deleteOne(
            (int) $id,
        );
        return $this->respondWithData(['message' => "County Deleted Successfully"]);
    }
}

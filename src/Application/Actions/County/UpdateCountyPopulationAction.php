<?php

declare(strict_types=1);

namespace App\Application\Actions\County;

use App\Domain\County\UpdateCountyLogic;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateCountyPopulationAction extends CountyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getFormData();
        $id = $this->resolveArg('county_id');
        $validForm = UpdateCountyLogic::validate($body, $id);
        if (!$validForm['isValid']) {
            return $this->respondWithData($validForm['errors'], 422);
        }
        $data = $this->countyRepository->updatePopulation(
            (int) $id,
            (int) $body['population'],
        );
        return $this->respondWithData($data);
    }
}

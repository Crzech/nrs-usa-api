<?php

declare(strict_types=1);

namespace App\Application\Actions\County;

use App\Domain\County\CreateCountyLogic;
use Psr\Http\Message\ResponseInterface as Response;

class CreateCountyAction extends CountyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getFormData();
        $validForm = CreateCountyLogic::validate($body);
        if (!$validForm['isValid']) {
            return $this->respondWithData($validForm['errors'], 422);
        }
        $data = $this->countyRepository->createOne(
            $body['name'],
            (int) $body['state_id'],
            $body['population']
        );
        return $this->respondWithData($data);
    }
}

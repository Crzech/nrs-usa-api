<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\CreateUserLogic;
use App\Domain\User\NotUniqueUserException;
use Psr\Http\Message\ResponseInterface as Response;

class CreateUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        try {
            $body = $this->getFormData();
            $validForm = CreateUserLogic::validate($body);
            if (!$validForm['isValid']) {
                return $this->respondWithData($validForm['errors'], 422);
            }
            $encPass = CreateUserLogic::encryptPassword($body['password']);
            $data = $this->userRepository->createOne($body['username'], $encPass, $body['email']);
            return $this->respondWithData($data);
        } catch (NotUniqueUserException $ex) {
            return $this->respondWithData(["error" => $ex->getMessage()], 422);
        }

    }
}

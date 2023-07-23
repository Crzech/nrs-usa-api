<?php
declare(strict_types=1);

namespace App\Application\Actions\Auth;


use App\Domain\Auth\AuthenticateWithUsernameAndPasswordLogic;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface as Response;

class AuthenticateByUsernameAndPasswordAction extends AuthAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getFormData();
        $validForm = AuthenticateWithUsernameAndPasswordLogic::validate($body);
        if (!$validForm['isValid']) {
            return $this->respondWithData($validForm['errors'], 422);
        }
        $dbUser = $this->userRepository->findByUsername($body["username"]);
        if (!isset($dbUser)) {
            return $this->respondWithData(["message" => "Username or password are incorrect"], 401);
        }
        $isValidPass = AuthenticateWithUsernameAndPasswordLogic::verifyUserPassword(
            $dbUser['password'],
            $body["password"]
        );
        if (!$isValidPass) {
            return $this->respondWithData(["message" => "Username or password are incorrect"], 401);
        }

        $expire = (new \DateTime("now"))->modify("+1 hour")->format("Y-m-d H:i:s");
        $token = JWT::encode(["expired_at" => $expire, "username" => $body["username"]], $_ENV["JWT_SECRET"]);

        return $this->respondWithData(['token' => $token]);
    }
}

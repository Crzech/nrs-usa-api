<?php
declare(strict_types=1);

namespace App\Domain\Auth;

class AuthenticateWithUsernameAndPasswordLogic
{
    static function validate($body)
    {
        $username = $body['username'] ?? null;
        $password = $body['password'] ?? null;
        $response = [
            'isValid' => true,
            'errors' => [
                'username' => null,
                'password' => null,
            ]
        ];
        if (!isset($username) || !strlen($username)) {
            $response['isValid'] = false;
            $response['errors']['username'] = "Username field should not be empty";
        }
        if (!isset($password) || !strlen($password)) {
            $response['isValid'] = false;
            $response['errors']['password'] = "Password field should not be empty";
        }

        return $response;
    }

    static function verifyUserPassword($dbPassword, $userPassword)
    {
        return password_verify($userPassword, $dbPassword);
    }


}

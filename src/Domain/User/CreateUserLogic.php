<?php
declare(strict_types=1);

namespace App\Domain\User;

class CreateUserLogic
{
    static function validate($body)
    {
        $username = $body['username'] ?? null;
        $password = $body['password'] ?? null;
        $email = $body['email'] ?? null;
        $response = [
            'isValid' => true,
            'errors' => [
                'username' => null,
                'password' => null,
                'email' => null
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
        if (!isset($email) || !strlen($email)) {
            $response['isValid'] = false;
            $response['errors']['email'] = "E-mail should not be empty";
        }

        return $response;
    }

    static function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

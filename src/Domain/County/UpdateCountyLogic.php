<?php
declare(strict_types=1);

namespace App\Domain\County;

class UpdateCountyLogic
{
    static function validate($body, $id)
    {
        $population = $body['population'] ?? null;

        $response = [
            'isValid' => true,
            'errors' => [
                'id' => null,
                'population' => null
            ]
        ];
        if (!isset($id) || !strlen((string) $id) || (int) $id < 1) {
            $response['isValid'] = false;
            $response['errors']['id'] = "ID field should not be empty";
        }
        if (!isset($population) || !strlen((string) $population) || (int) $population < 1) {
            $response['isValid'] = false;
            $response['errors']['population'] = "Population field should not be empty and it should be greater than 0";
        }

        return $response;
    }
}

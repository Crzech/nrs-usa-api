<?php
declare(strict_types=1);

namespace App\Domain\County;

class CreateCountyLogic
{
    static function validate($body)
    {
        $name = $body['name'] ?? null;
        $stateId = $body['state_id'] ?? null;
        $population = $body['population'] ?? null;

        $response = [
            'isValid' => true,
            'errors' => [
                'name' => null,
                'state_id' => null,
                'population' => null
            ]
        ];
        if (!isset($name) || !strlen($name)) {
            $response['isValid'] = false;
            $response['errors']['name'] = "Name field should not be empty";
        }
        if (!isset($stateId) || !strlen((string) $stateId) || (int) $stateId < 1) {
            $response['isValid'] = false;
            $response['errors']['state_id'] = "State ID field should not be empty and it should be greater than 0";
        }
        if (!isset($population) || !strlen((string) $population) || (int) $population < 1) {
            $response['isValid'] = false;
            $response['errors']['population'] = "Population field should not be empty and it should be greater than 0";
        }

        return $response;
    }
}

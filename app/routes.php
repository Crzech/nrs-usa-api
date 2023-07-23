<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\State\ListStatesAction;
use App\Application\Actions\County\FindCountyByIdAction;
use App\Application\Actions\State\ListCountiesByStateAction;
use App\Application\Actions\Auth\AuthenticateByUsernameAndPasswordAction;
use App\Application\Actions\County\CreateCountyAction;
use App\Application\Actions\County\UpdateCountyPopulationAction;
use App\Application\Actions\County\DeleteCountyAction;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->post("/user", CreateUserAction::class);
    $app->post('/authentication', AuthenticateByUsernameAndPasswordAction::class);

    $app->group('/states', function (Group $group) {
        $group->get('', ListStatesAction::class);
        $group->get('/{id}/counties', ListCountiesByStateAction::class);
    });

    $app->group('/counties', function (Group $group) {
        $group->post('', CreateCountyAction::class);
        $group->get('/{county_id}', FindCountyByIdAction::class);
        $group->put('/{county_id}', UpdateCountyPopulationAction::class);
        $group->delete('/{county_id}', DeleteCountyAction::class);
    });
};

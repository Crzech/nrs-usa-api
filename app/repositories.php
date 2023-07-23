<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\User\PostgresUserRepository;
use App\Infrastructure\Persistence\State\PostgreStateRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use App\Infrastructure\Persistence\Counties\PostgresCountiesRepository;

return function (ContainerBuilder $containerBuilder) {
    // Repositories injection
    $containerBuilder->addDefinitions([
        PostgresUserRepository::class => function (ContainerInterface $c) {
            $db = $c->get(PDO::class);
            return new PostgresUserRepository($db);
        },
        PostgreStateRepository::class => function (ContainerInterface $c) {
            $db = $c->get(PDO::class);
            return new PostgreStateRepository($db);
        },
        PostgresCountiesRepository::class => function (ContainerInterface $c) {
            $db = $c->get(PDO::class);
            return new PostgresCountiesRepository($db);
        }
    ]);
};

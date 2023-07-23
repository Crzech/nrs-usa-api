# NRS-USA-POPULATION-API
This project is a PHP API server built over Slim Framework 4, PHP 8.2 and PostgreSQL 15.3.

## Folder Structure
I used https://github.com/slimphp/Slim-Skeleton skeleton so folder structure tries to use Clean Architecture principles with PSR7 standard and PHP-DI dependency injection.

Importan files/folders are marked with `**`

```
├── app**                   # Configuration files
├── docker**                # Dockerfiles, configuration files and database volume
├── sql**                   # Database configuration/seeding files (INCLUDES BASH SCRIPT TO SEED DATABASE)
├── docs                    # Documentation files
├── logs                    # Log files
├── public                  # Web server files
├── src                     # PHP source code (The App namespace)
│   ├── Aplication          # Network Layer
|   |       ├── Actions**   # Controllers
│   ├── Domain**            # The business logic
│   ├── InfraStructure
            ├── Persistence**  # Data Layer
├── composer.json           # Project dependencies
└── README.md               # This file
```

## Steps to run the application
1. [Install Docker](https://docs.docker.com/desktop/?_gl=1*5wfq8t*_ga*MTQ2MjM3MDMwNC4xNjkwMDAyOTUy*_ga_XJWPQMJYHQ*MTY5MDA3NjM2Mi4yLjEuMTY5MDA3NjM2Ni41Ni4wLjA.) if you don't have it.
2. Install php and composer if you don't have it
3. Install [pSQL client](https://www.postgresql.org/download/) to be able to run psql command
4. Run composer install in the root folder of this project
5. Run docker-compose up -d --build to start containers
6. cd into `sql/` dir using a bash compatible shell (Gitbash recommended for windows)
7. Run `bash database-script.sh` to create tables and seed the database
8. All ready, project's curl commands could be found at `docs/` directory.

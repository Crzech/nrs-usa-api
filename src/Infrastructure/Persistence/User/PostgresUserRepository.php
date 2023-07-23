<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;
use App\Domain\User\NotUniqueUserException;


class PostgresUserRepository
{
    private $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function findById($id)
    {
        $sth = $this->db->prepare(
            "SELECT username, email, created_on FROM Users WHERE id = ? "
        );
        $sth->execute([$id]);
        return $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    public function createOne(string $username, string $password, string $email)
    {
        try {
            $sth = $this->db->prepare(
                "INSERT INTO Users (username, password, email) VALUES (?,?,?)"
            );
            $sth->execute([$username, $password, $email]);
            $userId = $this->db->lastInsertId();
        } catch (\PDOException $ex) {
            if ($ex->getCode() == 23505) {
                throw new NotUniqueUserException();
            }
            throw $ex;
        }
        return $this->findById($userId);
    }

    public function findByUsername($username)
    {
        $sth = $this->db->prepare(
            "SELECT * FROM Users WHERE username = ? "
        );
        $sth->execute([$username]);
        $results = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return count($results) < 1 ? null : $results[0];
    }

}

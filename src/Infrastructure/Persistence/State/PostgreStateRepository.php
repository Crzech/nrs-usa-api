<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\State;


class PostgreStateRepository
{
    private $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $sth = $this->db->prepare("SELECT * FROM States");
        $sth->execute();
        $data = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function getCounties(int $id)
    {
        $sth = $this->db->prepare("SELECT c.name, c.population
            FROM States s
            INNER JOIN Counties c ON s.state_id = c.state_id
            WHERE s.state_id = :id
            "
        );
        $sth->bindParam(":id", $id);
        $sth->execute();
        $data = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }
}

<?php
declare(strict_types=1);
namespace App\Infrastructure\Persistence\County;

use App\Domain\County\CountyNotFoundException;
use App\Domain\County\CountyNotValidStateException;

class PostgresCountiesRepository
{
    private $db;
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id)
    {
        $sth = $this->db->prepare("SELECT * FROM Counties WHERE county_id = :id");
        $sth->bindParam(":id", $id);
        $sth->execute();
        $data = $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
        if (!isset($data)) {
            throw new CountyNotFoundException();
        }
        return $data;
    }

    public function createOne(string $name, int $state_id, int $population)
    {
        try {
            $sth = $this->db->prepare(
                "INSERT INTO Counties (name, state_id, population) VALUES (?,?,?)"
            );
            $sth->execute([$name, $state_id, $population]);
            $countyId = $this->db->lastInsertId();
            return $this->findById((int) $countyId);
        } catch (\PDOException $ex) {
            if ($ex->getCode() == 23503) {
                throw new CountyNotValidStateException();
            }
            throw $ex;
        }
    }

    public function updatePopulation(int $id, int $population)
    {
        $sth = $this->db->prepare(
            "UPDATE Counties SET population = :p WHERE county_id = :id"
        );
        $sth->bindParam(":p", $population);
        $sth->bindParam(":id", $id);
        $sth->execute();
        return $this->findById((int) $id);
    }

    public function deleteOne(int $id)
    {
        $sth = $this->db->prepare(
            "DELETE FROM Counties WHERE county_id = :id"
        );
        $sth->bindParam(":id", $id);
        $sth->execute();
        return true;
    }

}

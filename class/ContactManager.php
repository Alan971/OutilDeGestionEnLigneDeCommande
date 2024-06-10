<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;

class ContactManager{
    private const QUERRYALL = "SELECT * FROM contact";


    public function findAll() : array
    {   
        $dbConnect = new DBConnect;
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare(self::QUERRYALL);
        $dbQuerry->execute();
        return $dbQuerry->fetchAll();
    }
}
<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;

class ContactManager{

    public function findAll() : array
    {   
        $dbConnect = new DBConnect();
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare("SELECT * FROM contact");
        $dbQuerry->execute();
        return $dbQuerry->fetchAll();
    }
}
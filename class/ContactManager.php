<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;
use RuntimeException;

class ContactManager{

    public function findAll() : array
    {   
        $dbConnect = new DBConnect();
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare("SELECT * FROM contact");
        $dbQuerry->execute();
        return $dbQuerry->fetchAll();
    }
    public function createContact($newContact) :void
    {
        $dbConnect = new DBConnect();
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare("INSERT INTO contact (`id`, `name`, `email`, `phone_number`) VALUES (NULL,?,?,?)");
        $dbQuerry->execute([$newContact[1],$newContact[2],$newContact[3]]);
        $dbQuerry->fetchAll();
    }
    public function deleteContact($id) : void
    {
        $dbConnect = new DBConnect();
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare("DELETE FROM contact WHERE 'id'=?");
        $dbQuerry->execute([$id]);
        $dbQuerry->fetchAll();
    }
}
<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;
use RuntimeException;

class ContactManager{

    private $db;
    
    public function __construct()
    {
        $this->db = (new DBConnect())->getPDO();
    }

    public function findAll() : array
    {   
        
        $dbQuerry = $this->db->prepare("SELECT * FROM contact");
        $dbQuerry->execute();
        return $dbQuerry->fetchAll();
    }
    public function createContact($newContact) :void
    {
        $dbQuerry = $this->db->prepare("INSERT INTO contact (`id`, `name`, `email`, `phone_number`) VALUES (NULL,?,?,?)");
        $dbQuerry->execute([$newContact[1],$newContact[2],$newContact[3]]);
        $dbQuerry->fetchAll();
    }
    public function deleteContact($id) : void
    {
        // note pour plus tard : WHERE id = :id est sans ''
        // car avec la supression ne se fait pas et ne retourne pas d'erreur
        $dbQuerry = $this->db->prepare("DELETE FROM contact WHERE id =:id");
        $dbQuerry->execute(['id'=>$id]);
        $dbQuerry->fetchAll();
    }

    public function modifyContact($Contact) :void
    {
        $dbQuerry = $this->db->prepare("UPDATE contact SET  `name`= :name, `email`= :email , `phone_number`= :phone_number WHERE id= :id");
        $dbQuerry->execute(['name'=>$Contact['name'], 'email'=>$Contact['email'],'phone_number'=>$Contact['phone_number'],'id'=>$Contact['id']]);
        $dbQuerry->fetchAll();
    }
}
<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;
use class\bdd\ContactManager;

class Contact extends ContactManager{

    public function __construct(private $id=NULL, private string $name="", private string $email="", private string $phone="") 
    {
        // appel de findAll pour savoir si $id existe en bdd
        foreach($this->findAll() as $Contact)
        {
            if ($id==$Contact[0])
            {
                $this->id=$id;
                $this->name=$Contact[1];
                $this->email=$Contact[2];
                $this->phone=$Contact[3];
            }
        }
    }

    // gestion de base de donnée
    // récupérer les informations individuelles
    private function getDB($id) : void
    {
        $querryGetContact = "SELECT * FROM contact WHERE id=?";
        $dbConnect = new DBConnect;
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare($querryGetContact);
        $dbQuerry->execute([$this->id]);
        $dbQuerry->fetchAll();

    }
    private function setAddContactDB() : void
    {
        $querrySetContact = "INSERT INTO `contact` (`id`, `name`, `email`, `phone_number`) VALUES (NULL, ?, ?, ?);";
        $dbConnect = new DBConnect;
        $db = $dbConnect->getPDO();
        $dbQuerry = $db->prepare($querrySetContact);
        $dbQuerry->execute([$this->name, $this->email, $this->phone]);
        $dbQuerry->fetchAll();
    } 

    // gestion de récupération et de creation d'objet
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getName() : ?string
    {
        return $this->name;
    }
    public function setName(?string $name) :void
    {
        $this->name=$name;
    }
    public function getEmail() : ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email) : void
    {
        $this->email=$email;
    }
    public function getPhone() : ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone) :void
    {
        $this->phone= $phone;
    }
    public function toString() : string
    {
        return $this->getId() . ", " . $this->getName() . ", " . $this->getEmail() . ", " . $this->getPhone();
    }
}
<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;


class Contact {

    public function __construct(private $id=NULL, private string $name="", private string $email="", private string $phone="") 
    {
       
    }

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
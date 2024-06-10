<?php
declare(strict_types=1);

namespace class\bdd;
use class\bdd\DBConnect;
use class\bdd\ContactManager;

class Contact extends ContactManager{

    // private int $id=NULL;
    private string $name ="";
    private string $email="";
    private string $phone="";

    public function __construct(private $id=NULL) 
    {
        array_search($id, $this->findAll());
        if(!is_null($id)){
            $name=$this->findAll()[$id][1];
            $email=$this->findAll()[$id][2];
            $phone=$this->findAll()[$id][3];
        }
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



}
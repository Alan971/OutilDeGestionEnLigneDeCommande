<?php
declare(strict_types=1);

namespace class;

use class\bdd\ContactManager;
use class\bdd\Contact;

class Command {
    
    public ?string $id=NULL;

    public function list() : void
    {
        // Je ne sais pas mettre à la ligne 
        echo "Liste des contacts : id, name, email, number \n";
        $contacts= new ContactManager();
        foreach($contacts->findAll() as $contact)
        {
            $contactObj= new Contact($contact['id'],$contact['name'], $contact['email'], $contact['phone_number']);
            echo $contactObj->toString() ."\n";
        }
    }

    public function detail( $id) :void
    {
        $detailToPrint = "";

        $intId=intval($id);
        if(!is_null($intId))
        {
            $contacts= new ContactManager();
            foreach($contacts->findAll() as $contact)
            {
                $contactObj= new Contact($contact['id'],$contact['name'], $contact['email'], $contact['phone_number']);
                if($contactObj->getId() == $intId)
                {
                    $detailToPrint =  $contactObj->toString();
                }
            }
            if($detailToPrint == "")
            {
                $detailToPrint = "erreur de saisie \n";
            }
        }
        else 
        {
            $detailToPrint = "erreur de saisie \n";
        }
        echo $detailToPrint . "\n";
    }

    public function create() : void
    {
        
    }

    public function delete() :void
    {

    }

    public function help() :void
    {
        // voir nowdoc et heredoc
        echo <<<EOT
        help : affiche cette aide

        list : liste les contacts

        create [name], [email], [phone number] : crée un contact

        delete [id] : supprime un contact

        quit : quitte le programme

 

        Attention à la syntaxe des commandes, les espaces et virgules sont importants.

        EOT;
    }
    public function quit() : void
    {
        exit(0);
    }

}
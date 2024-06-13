<?php
declare(strict_types=1);

namespace class;

use class\bdd\ContactManager;
use class\bdd\Contact;

class Command {
    
    private $contact;

    public function __construct()
    {
        $this->contact = new ContactManager;
    }

    public function list() : void
    {
        // Je ne sais pas mettre à la ligne 
        echo "Liste des contacts : id, name, email, number \n";
        
        foreach($this->contact->findAll() as $contact)
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
            foreach($this->contact->findAll() as $contact)
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

    public function create($newContact) : void
    {
        $detailToPrint = "";
        $regex = "#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#"; 
        // comptage du nombre d'argument
        if(count($newContact) != 4)
        {
            $detailToPrint = "Erreur de saisie : le nombre d'argument est incorrect. \n";
        }
        else
        {
            if(strlen($newContact[1]) != strripos($newContact[1],",")+1 || strlen($newContact[2]) != strripos($newContact[2],",")+1)
            {
                $detailToPrint = "Erreur de saisie : une virgule ou plus est manquante. \n";
            }
            // controle de présence d'un email et téléphone correct
            elseif(filter_var($newContact[2], FILTER_VALIDATE_EMAIL) || !preg_match( $regex, $newContact[3]))
            {
                $detailToPrint = "Erreur de saisie : l'email ou le téléphone n'est pas valide. \n";
            }
            else {
                // suppression des virgules en fin d'argument. seul deux en possèdent
                $newContact[1] = substr($newContact[1],0,strlen($newContact[1])-1);
                $newContact[2] = substr($newContact[2],0,strlen($newContact[2])-1);
                // enregistrement dans la base
                $contact= new ContactManager();
                $contact->createContact($newContact);
                $detailToPrint = "Enregistrement réalisé. \n";
            }
        }
        echo $detailToPrint;
    }

    public function delete($id) :void
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
                    $contacts->deleteContact($intId);
                    $detailToPrint =  "L'opération de supression du contact " . $contactObj->getName() . " a bien été réalisée. \n";
                }
            }
            if($detailToPrint == "")
            {
                $detailToPrint = "Erreur : le numéro de l'ID n'est pas valide \n";
            }
            echo $detailToPrint;
        }
    }

    public function modify($modifiingContact) : void
    {
        $detailToPrint = "";
        $regex = "#(\+[0-9]{2}\([0-9]\))?[0-9]{10}#"; 

        // id suppression de la virgule et conversion en int
        $id=intval(rtrim($modifiingContact[1],","));
        // contrôle du nombre d'arguments 
        if(count($modifiingContact) != 5)
        {
            $detailToPrint = "Erreur de saisie : le nombre d'argument est incorrect. \n";
        }
        elseif(!is_null($id))
        {
            // controle de présence de virgule y compris de id
            if(strlen($modifiingContact[1]) != strripos($modifiingContact[1],",")+1 || strlen($modifiingContact[2]) != strripos($modifiingContact[2],",")+1 || strlen($modifiingContact[3]) != strripos($modifiingContact[3],",")+1)
            {
                $detailToPrint = "Erreur de saisie : une virgule ou plus est manquante. \n";
            }
            else 
            {
                // creation de classe d'usage des bdd
                $contacts = new ContactManager();
                foreach($contacts->findAll() as $contact)
                {
                    $contactObj= new Contact($contact['id'],$contact['name'], $contact['email'], $contact['phone_number']);
                    if($contactObj->getId() == $id)
                    {

                        // mise en forme du tableau et suppression des virgules en fin d'argument. seul deux en possèdent
                        $contact['id']= $id;
                        $contact['name'] = substr($modifiingContact['2'],0,strlen($modifiingContact['2'])-1);
                        $contact['email'] = substr($modifiingContact['3'],0,strlen($modifiingContact['3'])-1);
                        $contact['phone_number']=substr($modifiingContact['4'],0,strlen($modifiingContact['4'])-1);
                        // controle de présence d'un email et téléphone correct
                        if(filter_var($modifiingContact['3'], FILTER_VALIDATE_EMAIL) || !preg_match( $regex, $modifiingContact['4']))
                        {
                            echo $modifiingContact['3'] . " et " . $modifiingContact['4'] . "\n";
                            $detailToPrint = "Erreur de saisie : l'email ou le téléphone n'est pas valide. \n";
                        }
                        else
                        {
                            $contacts->modifyContact($contact);
                            $detailToPrint =  "L'opération de modification du contact id n° " . $contactObj->getId() . " a bien été réalisée. \n";
                        }
                    }
                }
                if($detailToPrint == "")
                {
                    $detailToPrint = "Erreur : le numéro de l'ID n'est pas valide \n";
                }
            }
        }
        echo $detailToPrint;
    }

    public function help() :void
    {
        // voir nowdoc et heredoc
        echo <<<EOT
        help : affiche cette aide

        list : liste les contacts

        create [name], [email], [phone number] : crée un contact

        modify [id], [name], [email], [phone number] : modifie le contact si l'id existe

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
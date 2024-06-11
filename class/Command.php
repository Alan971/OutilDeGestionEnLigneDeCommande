<?php
declare(strict_types=1);

namespace class;

use class\bdd\ContactManager;
use class\bdd\Contact;

class Command {

    public function list() : void
    {
        echo "Liste des contacts :<BR> id, name, email, number <BR>";
        $contacts= new ContactManager();
        foreach($contacts->findAll() as $contact)
        {
            $contactObj= new Contact($contact[0],$contact[1], $contact[2], $contact[3]);
            echo $contactObj->toString();
        }
    }
    

}
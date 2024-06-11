<?php
declare(strict_types=1);

// spl_autoload_register();
spl_autoload_register(
       static function(string $fqcn) :void {
        $path = str_replace(['bdd', '\\'], ['', '/'], $fqcn) . '.php';
        require_once($path);                               
    });

use class\bdd\ContactManager;
use class\bdd\Contact;
use class\Command;


// test de la classe Contact
// $id=3;
// $Unique=new Contact($id);
// echo $Unique->toString();


while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");
    $command = new Command;
    switch($line){
        case 'list':
            $command->list();
            break;
        case 'detail':

            break;
        case 'create':

            break;
        case 'delete':

            break;
        case 'quit' :

            break;
        case 'help' : 

            break;
        
        default:
    }
}
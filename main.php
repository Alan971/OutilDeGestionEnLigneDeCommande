<?php
declare(strict_types=1);

// spl_autoload_register();
spl_autoload_register(
       static function(string $fqcn) :void {
        $path = str_replace(['bdd', '\\'], ['', '/'], $fqcn) . '.php';
        require_once($path);                               
    });

use class\bdd\ContactManager;

$contacts= new ContactManager();
        foreach($contacts->findAll() as $contact)
        {
            $i=0;
            while($i<4)
            {
                echo $contact[$i] . ", " ;
                $i++;
            }
        }

// while (true) {
//     $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");
//     switch($line){
//     case 'list':
//         echo "Liste des contacts :<BR> id, name, email, number <BR>";
//         $contacts= new ContactManager();
//         foreach($contacts->findAll() as $contact)
//         {
//             $i=0;
//             while($i<4)
//             {
//                 echo $contact[$i] . ", " ;
//                 $i++;
//             }
//         }
//         break;
//     case 'detail':

//         break;
//     case 'create':

//         break;
//     case 'delete':

//         break;
//     case 'quit' :

//         break;
//     case 'help' : 

//         break;
//     }
    
// }
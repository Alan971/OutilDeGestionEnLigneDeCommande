<?php
declare(strict_types=1);

spl_autoload_register(
       static function(string $fqcn) :void {
        $path = str_replace(['bdd', '\\'], ['', '/'], $fqcn) . '.php';
        require_once($path);                               
    });

use class\bdd\ContactManager;
use class\bdd\Contact;
use class\Command;

while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, modify,  delete, quit) : ");
    $args = explode(" ", $line);
    $command = new Command();
    switch($args[0]){
        case 'list':
            $command->list();
            break;
        case 'detail':
            $command->detail($args[1]);
            break;
        case 'modify':
            $command->modify($args);
            break;
        case 'create':
            $command->create($args);
            break;
        case 'delete':
            $command->delete($args[1]);
            break;
        case 'quit' :
            $command->quit();
            break;
        case 'help' : 
            $command->help();
            break;
        default:
            echo "commande incorrecte\n";
    }
}
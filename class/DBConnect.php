<?php
declare(strict_types=1);
namespace class\bdd;
use PDO;
use Exception;

 class DBConnect {
    // mysql est le nom du container docker
    //root et dbroot sont les login et mdp
    private const CONNECT ='mysql:host=mysql;dbname=dbCommandLineInterface;charset=utf8';
    private const LOGIN ='root';
    private const PWD ='dbroot';

    public function getPDO () : PDO
    {
        try {
            $db = new PDO(
                self::CONNECT,
                self::LOGIN,
                self::PWD
            );
            // $db = new PDO('mysql:host=mysql;dbname=dbCommandLineInterface;charset=utf8','root','dbroot');
        }
        //en cas d'erreur on affiche le message et on arrête tout
        catch(Exception $e) {
            die('erreur : ' . $e ->getMessage());
        }
        return  $db;
    }

}
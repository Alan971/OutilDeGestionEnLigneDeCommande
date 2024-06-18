<?php
declare(strict_types=1);
namespace class\bdd;
use PDO;
use Exception;

 class DBConnect {
    private const CONNECT ='mysql:host=127.0.0.1;dbname=dbCommandLineInterface;charset=utf8';
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
        }
        catch(Exception $e) {
            die('Erreur : ' . $e ->getMessage());
        }
        return  $db;
    }

}
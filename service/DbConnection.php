<?php

    namespace service;

    use \PDO;
    use \PDOException;
    class DbConnection{
        private static $connexion;

        public static function getConnection(){

            if (self::$connexion==null) {
                try {
                    // self::$connexion=new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11486821','sql11486821','TqIzAvCvEb');
                    self::$connexion=new PDO("sqlite:".__DIR__."db.db");
                    // self::$connexion=new PDO('mysql:host=localhost;dbname=gestion_stock','root','');
                } catch (PDOException $e) {
                    
                    echo"connection echouée".$e->getMessage();
                }
            } 
            return self::$connexion;

        }
    }

?>
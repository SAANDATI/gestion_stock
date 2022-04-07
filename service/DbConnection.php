<?php

    namespace service;

    use \PDO;
    use \PDOException;
    class DbConnection{

        private static $connexion;

        public static function getConnection(){

            if (self::$connexion==null) {
                try {
                    self::$connexion=new PDO('mysql:host=localhost;dbname=gestion_stock','root','');
                } catch (PDOException $e) {
                    
                    echo"connection echouée".$e->getMessage();
                }
            } 
            return self::$connexion;

        }
    }

?>
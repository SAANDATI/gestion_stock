<?php

namespace controller;

require_once("../vendor/autoload.php");

use model\Categorie;
use service\CategorieService;


class CategorieController{

    public static function controllerManager(){

        $view = isset($_GET['view'])?$_GET['view']:NULL;
        $action = isset($_GET['action'])?$_GET['action']:NULL;
        
        // switch ($view) {
        //     case 'read':
        //         self::includeView($view);
        //         break;
            
        //     case 'create':
        //         self::includeView($view);
        //         break;

        //     case 'update':
        //         self::includeView($view);
        //         break;

        //     default:
        //         self::includeView("read");
        //         break;
        // }

        switch ($action) {
            case 'read':
                self::read();
                break;
            
            case 'create':
                self::create();
                break;
            
            case 'delete':
                self::delete();
                break;

            case 'one':
                self::one();
                break;

            case 'update':
                self::update();
                break;

            default:
                // echo "Error!!!";
                break;
        }

 
    }

    public static function includeView($view){

        require_once('./view/categorie/'.$view.'.php');
    }

    public static function read(){

        header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header("Content-type: application/json");

        // return CategorieService::read();
        echo json_encode(CategorieService::read());
    }

    public static function create(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        extract($_POST);
        if (!empty($libelle)) {
            
            $categorie  = new Categorie(null, $libelle);
            CategorieService::create($categorie);
            echo "OK";

        } else {
            
            echo "veuiller remplir tout les champs!!!";
        }
        
    }

    public static function update(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        extract($_GET);
        extract($_POST);
        if (!empty($libelle)) {
            
            $categorie  = new Categorie($id, $libelle);
            CategorieService::update($categorie);
            echo "OK";

        } else {
            
            echo "veuiller remplir tout les champs!!!";
        }
        
    }

    public static function delete(){

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");

        extract($_GET);

        CategorieService::delete($id);
        echo "Suppression reusit";
        
    }

    public static function one(){

        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json");
        extract($_GET);

        echo 'Bonjour';
        // echo  json_encode(CategorieService::one($id));
       
    }
    
    

}
CategorieController::controllerManager();

?>
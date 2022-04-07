<?php

namespace controller;
class CategorieController{

    public static function controllerManager(){

        $view = isset($_GET['view'])?$_GET['view']:NULL;
        $action = isset($_GET['action'])?$_GET['action']:NULL;
        
        switch ($view) {
            case 'read':
                self::includeView($view);
                break;
            
            case 'create':
                self::includeView($view);
                break;

            case 'update':
                self::includeView($view);
                break;

            default:
                self::includeView("read");
                break;
        }
 
    }

    public static function includeView($view){

        require_once('./view/categorie/'.$view.'.php');
    }


}
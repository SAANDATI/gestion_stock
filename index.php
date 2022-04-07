<?php
require_once('./template/template.php');
// require_once('../template/template.php')
require_once('./vendor/autoload.php');
use model\Categorie;
use service\CategorieService;
use controller\CategorieController;

CategorieController::controllerManager();

// $categorie = new Categorie(1, 'java');

// // CategorieService::create($categorie);
// // CategorieService::update($categorie);
// CategorieService::delete(1);
// var_dump(CategorieService::read());
?>
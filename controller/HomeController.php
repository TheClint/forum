<?php

    namespace Controller;

    // pour importer ces classes
    use App\AbstractController;
    use App\ControllerInterface;
use Model\Managers\CategorieManager;

    // extends est le mot clé pour définir un héritage, ici, HomeController hérite de AbstractController
    // implement est le mot clé pour définir l'interface, HomeController doit avoir à minima les méthodes définient dans son interface ControllerInterface 
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){

            $categorieManager = new CategorieManager();

            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    "categories" => $categorieManager->findAll()
                ]
            ];
        }
    }
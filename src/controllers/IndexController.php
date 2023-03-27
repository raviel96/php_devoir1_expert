<?php 
namespace App\controllers;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class IndexController {

    public function __construct() {
        $this->loadTwig();
    }

    private function loadTwig(){
        $loader = new FilesystemLoader('../views/');

        $twig = new Environment($loader, [
            'cache' => false,
        ]);
    }
}
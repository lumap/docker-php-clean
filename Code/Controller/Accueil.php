<?php
namespace Controller;

use Controller\View;

class Accueil extends Main
{
    public function DisplayAccueil()
    {
        View::Init("Bienvenue!");
        View::Display("Accueil");
    }
}
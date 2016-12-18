<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\User;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController extends Controller{
    /**
     * @function index
     * @param $request
     * @param $response
     * @return mixed
     * retour les informations vers la page d'accueil
     */
    public function index($request, $response){
        return $this->view->render($response, 'home.twig');
    }

    /**
     * @function home
     * @param $request
     * @param $response
     * @return string
     * retour les informations vers la page Home
     */
    public function home($request, $response){
		return 'Home controller';
	}

    /**
     * @function contact
     * @param $request
     * @param $response
     * @return string
     * retour les informations vers la page Contact
     */
    public function contact($request, $response){
        return 'Contact controller';
    }
}

<?php 

    use Slim\Views\Twig as View;
    namespace App\Controllers;


    class HomeController extends Controller {

        function index($request, $response) {
            return $this->view->render($response, 'home.twig');
        }

    }






?>
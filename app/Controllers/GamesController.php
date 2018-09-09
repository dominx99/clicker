<?php

namespace App\Controllers;

use Slim\Http\Response;

class GamesController extends Controller
{
    public function index()
    {
        return $this->view->render(new Response(), 'home.twig');
    }
}

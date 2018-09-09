<?php

namespace App\Controllers;

use App\Models\User;
use Slim\Http\Response;

class UsersController extends Controller
{
    public function show()
    {
        $user = $this->auth->user();

        return (new Response())->withJson($user);
    }

    public function click()
    {
        $user = $this->auth->user();

        $user->increaseByClick();

        return (new Response())->withJson($user);
    }

    public function sec()
    {
        $user = $this->auth->user();

        $user->increaseBySec();

        return (new Response())->withJson($user);
    }

    public function best()
    {
        $users = User::orderBy('points', 'desc')->get()->take(10);

        return (new Response())->withJson($users);
    }
}

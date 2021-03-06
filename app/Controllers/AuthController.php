<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController extends Controller
{
    public function loginForm(Request $request, Response $response, $params)
    {
        if ($error = $request->getParam('error')) {
            $this->view->getEnvironment()->addGlobal('error', ['error' => $error]);
        }

        return $this->view->render(new Response(), 'auth/login.twig');
    }

    public function registerForm()
    {
        return $this->view->render(new Response(), 'auth/register.twig');
    }

    public function login(Request $request)
    {
        $params = $request->getParams();

        if (!$this->auth->attempt($params['nick'], $params['password'])) {
            return (new Response())->withRedirect($this->router->pathFor('auth.login', [], [
                'error' => true,
            ]));
        }

        return (new Response())->withRedirect($this->router->pathFor('home'));
    }

    public function register(Request $request)
    {
        $validation = $this->validator->validate($request, [
            'nick'             => v::notEmpty()->noWhitespace()->NickAvaible()->length(3, 12),
            'password'         => v::notEmpty()->length(6),
            'confirm_password' => v::ConfirmPassword($request->getParam('password')),
        ]);

        if ($validation->failed()) {
            return (new Response())->withRedirect($this->router->pathFor('auth.register'));
        }

        $params = $request->getParams();

        $user = User::create([
            'nick'     => $params['nick'],
            'password' => password_hash($params['password'], PASSWORD_DEFAULT),
        ]);

        $this->auth->authorize($user->id);

        return (new Response())->withRedirect($this->router->pathFor('home'));
    }

    public function logout()
    {
        $this->auth->logout();

        return (new Response())->withRedirect($this->router->pathFor('auth.login'));
    }
}

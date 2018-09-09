<?php

namespace App\Controllers;

use App\Models\Statistic;
use Slim\Http\Request;
use Slim\Http\Response;

class StatisticsController extends Controller
{
    public function buy(Request $request, Response $response, $params)
    {
        $user = $this->auth->user();

        if (!$stat = Statistic::where('level', $user['per_' . $params['type'] . '_level'] + 1)->where('type', $params['type'])->first()) {
            return (new Response())->withJson([
                'error' => 'cannot find next level',
            ]);
        }

        if (!$user->canBuyStatistic($stat)) {
            return (new Response())->withJson([
                'error' => 'You dont have enough money',
            ]);
        }

        $user->buy($stat);

        return (new Response())->withJson($user);
    }

    public function points()
    {
        // foreach (Statistic::get() as $stat) {
        //     $stat->delete();
        // }

        // for ($i = 1; $i <= 100; $i++) {
        //     $stat = new Statistic();

        //     $value = ceil($i * $i / 4);
        //     $level = $i;
        //     $j     = $i - 1;

        //     if ($i == 1) {
        //         $j = 0;
        //     }

        //     if ($value < $level) {
        //         $value = $level;
        //     }

        //     $stat->level = $level;
        //     $stat->type  = 'click';
        //     $stat->value = $value;
        //     $stat->cost  = ($j * $j * $j * 60);

        //     $stat->save();
        // }

        // for ($i = 1; $i <= 100; $i++) {
        //     $stat = new Statistic();

        //     $value = ceil($i * $i / 2);
        //     $level = $i;
        //     $j     = $i - 1;

        //     if ($i == 1) {
        //         $j = 0;
        //     }

        //     if ($value < $level) {
        //         $value = $level;
        //     }

        //     $stat->level = $level;
        //     $stat->type  = 'sec';
        //     $stat->value = $value;
        //     $stat->cost  = ($j * $j * $j * 60);

        //     $stat->save();
        // }

        return $this->view->render((new Response), 'points.twig');
    }
}

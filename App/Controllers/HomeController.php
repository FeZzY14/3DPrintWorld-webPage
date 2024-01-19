<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Item;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    private bool $messShown = false;
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $items = Item::getAll();
        $num = rand(0,(count($items)-3));

        $featured = [$items[$num], $items[$num + 1], $items[$num + 2]];

        $num = rand(0,(count($items)-3));

        $popular = [$items[$num], $items[$num + 1], $items[$num + 2]];

        $mess = $this->request()->getValue('showMess');

        return $this->html(
            [
                'showMess' => $mess,
                'featured' => $featured,
                'popular' => $popular
            ]
        );
    }
}

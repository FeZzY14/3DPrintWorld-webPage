<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Item;

class ItemController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function itemProperties(): Response
    {
        $id = $this->request()->getValue('id');
        $item = Item::getOne($id);
        return $this->html(
            [
                'item' => $item
            ]
        );
    }
}
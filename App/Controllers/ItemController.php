<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Item;
use App\Models\Review;

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

    public function loadReviews(): Response
    {
        $id = $this->request()->getValue('id');
        $offset = $this->request()->getValue('offset');
        $length = $this->request()->getValue('length');
        $reviews = Review::getAll('item_id like ?',[$id]);
        $reviews = array_slice($reviews, $offset, $length);
        return $this->json($reviews);
    }
}
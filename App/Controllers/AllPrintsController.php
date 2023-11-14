<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Item;

class AllPrintsController extends AControllerBase
{

    public function index(): Response
    {
        return $this->html();
    }

    public function allPrints(): Response
    {
        $pageNum = $this->request()->getValue('page');
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['submit'])) {
            $search = '%'.$formData['search'].'%';
            $allItems = Item::getAll(whereClause: "`title` like ? ",whereParams: [$search]);
        } else {
            $allItems = Item::getAll();
        }
        $items = array_slice($allItems, ($pageNum - 1) * 20, 20);

        $endItems = false;
        if (sizeof($items) < 20) {
            $endItems = true;
        } else {
            $itemsTest = array_slice($allItems, ($pageNum) * 20, 20);
            if (sizeof($itemsTest) == 0) {
                $endItems = true;
            }
        }
        return $this->html(
            [
                'endItems' => $endItems,
                'pageNum' => $pageNum,
                'items' => $items
            ]
        );
    }
}
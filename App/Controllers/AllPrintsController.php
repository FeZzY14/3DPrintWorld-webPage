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
        //done pagination for search not working
        $pageNum = $this->request()->getValue('page');
        $formData = $this->app->getRequest()->getPost();
        $search = $this->request()->getValue('search');
        $numOfRes = 0;
        if (isset($formData['submit'])) {
            $search = '%'.$formData['search'].'%';
            $allItems = Item::getAll(whereClause: "`title` like ? ",whereParams: [$search]);
            $numOfRes = sizeof($allItems);
        } else if ($search != '') {
            $allItems = Item::getAll(whereClause: "`title` like ? ",whereParams: [$search]);
            $numOfRes = sizeof($allItems);
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
                'numOfRes' => $numOfRes,
                'search' => $search,
                'endItems' => $endItems,
                'pageNum' => $pageNum,
                'items' => $items
            ]
        );
    }
}
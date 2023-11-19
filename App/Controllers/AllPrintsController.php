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
        $search = $this->request()->getValue('search');
        $category = $this->request()->getValue('category');
        $maxPrize = $this->request()->getValue('maxPrize');
        $minPrize = $this->request()->getValue('minPrize');
        $numOfRes = 0;

        if (isset($formData['searchSubmit'])) {
            if ($maxPrize != '' && $minPrize != '') {
                $search = '%'.$formData['search'].'%';
                $allItems = Item::getAll(whereClause: "`prize` >= ? and `prize` <= ? and `title` like ?", whereParams: [$minPrize, $maxPrize, $search]);
                $numOfRes = sizeof($allItems);
            } else {
                $search = '%'.$formData['search'].'%';
                $allItems = Item::getAll(whereClause: "`title` like ?",whereParams: [$search]);
                $numOfRes = sizeof($allItems);
            }
        } else if (isset($formData['filter'])) {
            if ($search != '') {
                $maxPrize = $formData['maxPrize'];
                $minPrize = $formData['minPrize'];
                $allItems = Item::getAll(whereClause: "`prize` >= ? and `prize` <= ? and `title` like ?", whereParams: [$minPrize, $maxPrize, $search]);
                $numOfRes = sizeof($allItems);
            } else {
                $maxPrize = $formData['maxPrize'];
                $minPrize = $formData['minPrize'];
                $allItems = Item::getAll(whereClause: "`prize` >= ? and `prize` <= ?", whereParams: [$minPrize, $maxPrize]);
                $numOfRes = sizeof($allItems);
            }
        } else if ($search != '') {
            $allItems = Item::getAll(whereClause: "`title` like ?", whereParams: [$search]);
            $numOfRes = sizeof($allItems);
        } else if ($maxPrize != '' && $minPrize != '') {
            $allItems = Item::getAll(whereClause: "`prize` >= ? and `prize` <= ?", whereParams: [$minPrize, $maxPrize]);
            $numOfRes = sizeof($allItems);
        } else {
            if ($category != '') {
                $allItems = Item::getAll(whereClause: "`category` = ?", whereParams: [$category]);
                $numOfRes = sizeof($allItems);
            } else {
                $allItems = Item::getAll();
            }
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
                'maxPrize' => $maxPrize,
                'minPrize' => $minPrize,
                'category' => $category,
                'numOfRes' => $numOfRes,
                'search' => $search,
                'endItems' => $endItems,
                'pageNum' => $pageNum,
                'items' => $items
            ]
        );
    }
}
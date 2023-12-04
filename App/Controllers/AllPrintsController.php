<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\Item;
use App\Models\User;

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
        $showMess = $this->request()->getValue('showMess');
        $numOfRes = 0;


        if (isset($formData['searchSubmit'])) {
            if ($maxPrize != '' && $minPrize != '') {
                $search = '%' . $formData['search'] . '%';
                $allItems = Item::getAll(whereClause: "`prize` >= ? and `prize` <= ? and `title` like ?", whereParams: [$minPrize, $maxPrize, $search]);
                $numOfRes = sizeof($allItems);
            } else {
                $search = '%' . $formData['search'] . '%';
                $allItems = Item::getAll(whereClause: "`title` like ?", whereParams: [$search]);
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
                'items' => $items,
                'showMess' => $showMess
            ]
        );
    }

    public function printForm(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if ($this->app->getAuth()->isAdmin()) {
            if ($this->request()->getValue('id') != null) {
                $id = $this->request()->getValue('id');
                $item = Item::getOne($id);
                return $this->html(
                    [
                        'item' => $item
                    ]);

            }

            if (isset($formData['submit'])) {
                $title = $this->request()->getValue('title');
                $category = $this->request()->getValue('category');
                $image = $this->request()->getValue('image');
                $description = $this->request()->getValue('description');
                $prize = $this->request()->getValue('prize');

                $print = new Item();
                $print->setTitle($title);
                $print->setCategory($category);
                $print->setPicture($image);
                $print->setText($description);
                $print->setPrize($prize);
                $print->save();

                return $this->redirect($this->url("allPrints.allPrints", ['page' => 1, 'showMess' => 1]));
            } else {
                return $this->html(['item' => null]);
            }
        } else {
            throw new HTTPException(401);
        }
    }

    public function removePrint(): Response
    {
        if ($this->app->getAuth()->isAdmin()) {
            $id = $this->request()->getValue('id');
            $item = Item::getOne($id);
            $item->delete();

            return $this->redirect($this->url("allPrints.allPrints", ['page' => 1, 'showMess' => 2]));
        } else {
            throw new HTTPException(401);
        }
    }

    public function modifyPrint(): Response
    {

        $formData = $this->app->getRequest()->getPost();
        $id = $this->request()->getValue('id');
        if ($this->app->getAuth()->isAdmin()) {
            if (isset($formData['submit'])) {
                $title = $formData['title'];
                $category = $formData['category'];;
                $image = $formData['image'];;
                $description = $formData['description'];;
                $prize = $formData['prize'];

                $print = Item::getOne($id);
                $print->setTitle($title);
                $print->setCategory($category);
                $print->setPicture($image);
                $print->setText($description);
                $print->setPrize($prize);
                $print->save();

                return $this->redirect($this->url("allPrints.allPrints", ['page' => 1, 'showMess' => 3]));
            } else {
                throw new HTTPException(401);
            }
        } else {
            throw new HTTPException(401);
        }
    }
}
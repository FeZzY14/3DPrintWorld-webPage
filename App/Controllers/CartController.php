<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\CartItem;
use App\Models\CartOrder;
use App\Models\Item;
use App\Models\UserItem;

class CartController extends AControllerBase
{

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function cart(): Response
    {
        $items = CartOrder::getAll(whereClause: "`userId` like ?", whereParams: [$this->app->getAuth()->getLoggedUserId()], orderBy: '`id` desc');

        $ids = [];
        $images = [];
        $titles = [];
        $colors = [];
        $materials = [];
        $layerHeights = [];
        $prices = [];

        for ($i = 0; $i < sizeof($items); $i++) {
            $cartItem = CartItem::getOne($items[$i]->getCartItemId());
            if (!is_null($cartItem->getItemId()) && !is_null($cartItem->getColor()) && !is_null($cartItem->getMaterial())) {
                $ids[$i] = $cartItem->getId();
                $classicItem = Item::getOne($cartItem->getItemId());
                $images[$i] = $classicItem->getPicture();
                $titles[$i] = $classicItem->getTitle();
                $prices[$i] = $classicItem->getPrize();

                $colors[$i] = $cartItem->getColor();
                $materials[$i] = $cartItem->getMaterial();
                $layerHeights[$i] = $cartItem->getLayerHeight();
            } else if (!is_null($cartItem->getItemId()) && is_null($cartItem->getColor()) && is_null($cartItem->getMaterial())){
                $customItem = UserItem::getOne($cartItem->getItemId());

                $ids[$i] = $cartItem->getId();
                $images[$i] = "https://blog.aspose.com/3d/convert-obj-to-stl-in-python/images/convert-obj-to-stl-in-python.jpg";
                $titles[$i] = $customItem->getFileName();
                $prices[$i] = $customItem->getPrize();

                $colors[$i] = $customItem->getColor();
                $materials[$i] = $customItem->getMaterial();
                $layerHeights[$i] = $customItem->getLayerHeight();
            } else {
                $ids[$i] = $cartItem->getId();

                $colors[$i] = $cartItem->getColor();
                $materials[$i] = $cartItem->getMaterial();
                $layerHeights[$i] = $cartItem->getLayerHeight();
                $titles[$i] = $cartItem->getTitle();
                $prices[$i] = $cartItem->getPrize();
                $images[$i] = "https://blog.aspose.com/3d/convert-obj-to-stl-in-python/images/convert-obj-to-stl-in-python.jpg";
            }
        }

        return $this->html([
            "ids" => $ids,
            "images" => $images,
            "titles" => $titles,
            "colors" => $colors,
            "materials" => $materials,
            "layerHeights" => $layerHeights,
            "prices" => $prices
        ]);
    }

    public function addToCart(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            throw new HTTPException(403);
        }
        $itemId = $this->request()->getValue('itemId');
        $color = $this->request()->getValue('color');
        $material = $this->request()->getValue('material');
        $layerHeight = $this->request()->getValue('layerHeight');
        $price = $this->request()->getValue('price');
        $title = $this->request()->getValue('title');

        $cartItem = new CartItem();
        $cartItem->setItemId($itemId);
        $cartItem->setUserId($this->app->getAuth()->getLoggedUserId());

        if ($color != null) {
            $cartItem->setColor("#" . $color);
        }
        $cartItem->setMaterial($material);
        $cartItem->setLayerHeight($layerHeight);

        if ($itemId == null) {
            $cartItem->setPrize($price);
            $cartItem->setTitle($title);
        }

        $cartItem->save();

        return $this->json(CartItem::getAll());
    }

    public function addToOrder(): Response
    {
        //$id = $this->request()->getValue('id');
        $orderItem = new CartOrder();
        $orderItem->setUserId($this->app->getAuth()->getLoggedUserId());

        $items = CartItem::getAll(whereClause: "`userId` like ?", whereParams: [$this->app->getAuth()->getLoggedUserId()], orderBy: '`id` desc');

        $orderItem->setCartItemId($items[0]->getId());
        $orderItem->save();

        return $this->json($orderItem);
    }

    public function removeOrder(): Response
    {
        $id = $this->request()->getValue('id');

        $item = CartItem::getOne($id);
        $item->delete();

        return $this->redirect($this->url("cart"));
    }
}
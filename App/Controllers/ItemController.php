<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
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
        $reviews = Review::getAll('item_id like ?',[$id]);
        $rating = 0;
        if (sizeof($reviews) != 0) {
            for ($i = 0; $i < sizeof($reviews); $i++) {
                $rating += $reviews[$i]->getStars();
            }
            $rating = (round($rating / sizeof($reviews), 1));
        }
        return $this->html(
            [
                'item' => $item,
                'rating' => $rating
            ]
        );
    }

    public function loadReviews(): Response
    {
        $id = $this->request()->getValue('id');
        $offset = $this->request()->getValue('offset');
        $length = $this->request()->getValue('length');
        $reviews = Review::getAll('item_id like ?',[$id], '`id` desc');
        $reviews = array_slice($reviews, $offset, $length);
        return $this->json($reviews);
    }

    public function addReview(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            throw new HTTPException(403);
        }
        $itemId = $this->request()->getValue('id');
        $text = $this->request()->getValue('text');
        $image = $this->request()->getValue('image');
        $rating = $this->request()->getValue('rating');
        $review = new Review();
        $review->setItemId($itemId);
        $review->setUserLogin($this->app->getAuth()->getLoggedUserName());
        $review->setText($text);
        if ($image != "") {
            $review->setImage($image);
        }

        $review->setStars($rating);
        date_default_timezone_set('Europe/Bratislava');
        $review->setDate(date("Y-m-d H:i:s"));
        $review->save();

        $reviews = Review::getAll();
        $reviews = array_slice($reviews, (sizeof($reviews) - 1), 1);
        return $this->json($reviews);
    }

    public function modifyReview(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            //throw new HTTPException(403);
        }
        $reviewId = $this->request()->getValue('id');
        $newText = $this->request()->getValue('text');
        $newImage = $this->request()->getValue('image');
        $newRating = $this->request()->getValue('rating');

        $review = Review::getOne($reviewId);
        $review->setText($newText);
        if ($newImage != "") {
            $review->setImage($newImage);
        } else {
            $review->setImage(NULL);
        }
        $review->setStars($newRating);
        date_default_timezone_set('Europe/Bratislava');
        $review->setDate(date("Y-m-d H:i:s"));
        $review->save();

        return $this->json($review);
    }

    public function deleteReview(): Response
    {
        if (!$this->app->getAuth()->isLogged()) {
            throw new HTTPException(403);
        }
        $itemId = $this->request()->getValue('id');
        $reviewId = $this->request()->getValue('reviewId');
        $review = Review::getOne($reviewId);
        $review->delete();

        return $this->redirect($this->url("item.itemProperties",['id' => $itemId]));
    }
}
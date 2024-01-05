<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\Response;
use App\Models\UserItem;

class CustomPrintController extends AControllerBase
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        return $this->html();
    }

    public function customPrint(): Response
    {
        $mess = $this->request()->getValue('showMess');
        return $this->html(['showMess' => $mess]);
    }

    public function savePrint(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['submit'])) {
            $userId = $this->request()->getValue('userId');
            $file = file_get_contents($_FILES['file']['tmp_name']);
            $fileName = $_FILES['file']['name'];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);;
            $color = $formData['color'];
            $material = $formData['material'];
            $layerHeight = $formData['layer'];
            $prize = null;
            if ($formData['prize'] != '-$' ) {
                $prize = floatval($formData['prize']);
            }
            $userItem = new UserItem();
            $userItem->setUserId($userId);
            $userItem->setFile($file);
            $userItem->setFileName($fileName);
            $userItem->setFiletype($fileType);
            $userItem->setColor($color);
            $userItem->setMaterial($material);
            $userItem->setLayerHeight($layerHeight);
            $userItem->setPrize($prize);

            $userItem->save();

            return $this->redirect($this->url("customPrint.customPrint", ['showMess' => 1]));
        } else {
            throw new HTTPException(403);
        }
    }
}
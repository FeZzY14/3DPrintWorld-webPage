<?php
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
?>
<link rel="stylesheet" href="public/css/itemPropCSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<div class="container item-listing">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="product image" src="<?= $data['item']->getPicture() ?>">
        </div>
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col>">
                        <h2><?= $data['item']->getTitle() ?></h2>
                    </div>
                    <div class="col>">
                        <div>
                            <?= $data['item']->getText() ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                Color
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                Material
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                Layer height
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col>">
                        <a href="http://www.bing.com" class="card-button item-page">add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
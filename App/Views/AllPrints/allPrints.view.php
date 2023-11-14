<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\Router $router */
/** @var Array $data */
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/allItems2.CSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<div class="search-bar">
    <form class="d-flex" role="search" method="post" action="<?= $link->url('allPrints.allPrints')?>">
        <input name="search" id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success search-button" name="submit" type="submit">Search</button>
    </form>
</div>

<nav class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
    <ul class="nav flex-column text-white w-100">
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>toys and games
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">Puzzle</a></li>
                    <li><a href="#" class="collapse-link">Toys for children</a></li>
                    <li><a href="#" class="collapse-link">Table games</a></li>
                    <li><a href="#" class="collapse-link">Action figures</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse1" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>household
            </button>
            <div class="collapse" id="orders-collapse1">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">..</a></li>
                    <li><a href="#" class="collapse-link">..</a></li>
                    <li><a href="#" class="collapse-link">..</a></li>
                    <li><a href="#" class="collapse-link">..</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse2" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>kitchen
            </button>
            <div class="collapse" id="orders-collapse2">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse3" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>electronic accessories
            </button>
            <div class="collapse" id="orders-collapse3">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse4" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>garden and plants
            </button>
            <div class="collapse" id="orders-collapse4">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse5" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>office supplies
            </button>
            <div class="collapse" id="orders-collapse5">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse6" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>education
            </button>
            <div class="collapse" id="orders-collapse6">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse7" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>car accessories
            </button>
            <div class="collapse" id="orders-collapse7">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse8" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>sports and outdoor
            </button>
            <div class="collapse" id="orders-collapse8">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                    <li><a href="#" class="collapse-link">--</a></li>
                </ul>
            </div>
    </ul>
</nav>

<div class="p-1 my-container active-cont side-bar-button">
    <a class="btn border-1" id="menu-btn">categories
        <i class="bx bx-menu cat-button"></i>
    </a>
</div>
<script>
    var menu_btn = document.querySelector("#menu-btn");
    var sidebar = document.querySelector("#sidebar");
    var container = document.querySelector(".my-container");
    sidebar.classList.toggle("active-nav", false);
    container.classList.toggle("active-cont", false);
    menu_btn.addEventListener("click", () => {
        sidebar.classList.toggle("active-nav");
        container.classList.toggle("active-cont");
    });
</script>
<div class="container">
    <div class="row">
        <?php
        $rowNum = 1;
        foreach ($data['items'] as $item) {
            $rowNum++; ?>
            <div class="col-md-3">
                <div class="card-sl">
                    <a class="item-page-link" href="<?= $link->url('item.itemProperties', ['id' => $item->getId()]) ?>">
                        <img class="card-img-top" alt="product image" src="<?= $item->getPicture() ?>">
                        <div class="card-body">
                            <h3 class="card-title"><?= $item->getTitle() ?></h3>
                            <p class="card-text">
                                <?= $item->getText() ?>
                            </p>
                            <h3 class="card-prize"><?= strval($item->getPrize()) ?>$</h3>
                        </div>
                    </a>
                    <a href="http://www.bing.com" class="card-button">add to cart</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<nav>
    <ul class="pagination justify-content-center">
        <?php if ($data['pageNum'] > 1) { ?>
            <li class="page-item">
                <a class="page-link" href="<?= $link->url('allPrints.allPrints', ['page' => ($data['pageNum'] - 1)]) ?>"
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo; previous</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!$data['endItems']) { ?>
            <li class="page-item">
                <a class="page-link" href="<?= $link->url('allPrints.allPrints', ['page' => ($data['pageNum'] + 1)]) ?>"
                   aria-label="Next">
                    <span aria-hidden="true">next &raquo;</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
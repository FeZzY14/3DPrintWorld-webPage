<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\Router $router */
/** @var Array $data */
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/allItemsCSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="public/js/cartScript.js"></script>
<?php if ($data['showMess'] == 1) { ?>
    <div class="container">
        <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-file-plus"></i>
                You have successfully added new print.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php } else if ($data['showMess'] == 2) { ?>
    <div class="container">
        <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-file-minus"></i>
                The print was successfully removed.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php } else if ($data['showMess'] == 3) { ?>
    <div class="container">
        <div class="row">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-plus-square"></i>
                The print was successfully modified.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
<?php } ?>
<div class="filters">
    <div class="search-bar">
        <form class="d-flex" role="search" method="post"
              action="<?= $link->url('allPrints.allPrints', ['page' => 1, 'minPrize' => $data['minPrize'], 'maxPrize' => $data['maxPrize']]) ?>">
            <div class="input-group">
                <input name="search" id="search" class="form-control" type="search" placeholder="Search"
                       aria-label="Search">
                <button class="btn search-button" name="searchSubmit">Search</button>
            </div>
        </form>
    </div>
    <form class="d-flex" role="form" method="post"
          action="<?= $link->url('allPrints.allPrints', ['page' => 1, 'search' => $data['search']]) ?>">
        <div class="prize">
            <div class="input-group prize-group">
                <input type="number" min="0" max="1000" class="form-control" placeholder="min prize"
                       aria-label="min prize" name="minPrize" required>
                <span class="input-group-text">-</span>
                <input type="number" min="0" max="1000" class="form-control" placeholder="max prize"
                       aria-label="max prize" name="maxPrize" required>
                <button class="btn search-button" name="filter">Filter</button>
            </div>
        </div>
    </form>
</div>
<?php if ($auth->isAdmin()) { ?>
    <div class="add-button-div">
        <a href="<?= $link->url("allPrints.printForm") ?>">
            <button class="btn search-button add-button">Add print
            </button>
        </a>
    </div>
<?php } ?>

<?php if ($data['search'] != '' && $data['minPrize'] != '' && $data['maxPrize']) { ?>
    <div class="result-text">
        <?= $data['numOfRes'] ?> results for search: '<?= trim($data['search'], '%') ?>' and
        for min prize <?= $data['minPrize'] ?>$ and max prize <?= $data['maxPrize'] ?>$<br>
        <a class="remove-search" href="<?= $link->url("allPrints.allPrints", ['page' => 1]) ?>">remove filters</a>
    </div>
<?php } else if ($data['category'] != '') { ?>
    <div class="result-text">
        <?= $data['numOfRes'] ?> results for category: '<?= trim($data['category'], '%') ?>'<br>
        <a class="remove-search" href="<?= $link->url("allPrints.allPrints", ['page' => 1]) ?>">remove filter</a>
    </div>
<?php } else if ($data['minPrize'] != '' && $data['maxPrize']) { ?>
    <div class="result-text">
        <?= $data['numOfRes'] ?> results for min prize <?= $data['minPrize'] ?>$ and max prize <?= $data['maxPrize'] ?>$<br>
        <a class="remove-search" href="<?= $link->url("allPrints.allPrints", ['page' => 1]) ?>">remove filter</a>
    </div>
<?php } else if ($data['search'] != '') { ?>
    <div class="result-text">
        <?= $data['numOfRes'] ?> results for search: '<?= trim($data['search'], '%') ?>'<br>
        <a class="remove-search" href="<?= $link->url("allPrints.allPrints", ['page' => 1]) ?>">remove search</a>
    </div>
<?php } ?>

<nav class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
    <ul class="nav flex-column text-white w-100">
        <li class="nav-item">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                    data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                <i class="bi bi-caret-right-fill arrow-sidebar"></i>toys and games
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Puzzle", 'page' => 1]) ?>"
                           class="collapse-link">Puzzle</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Toys for children", 'page' => 1]) ?>"
                           class="collapse-link">Toys for children</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Table games", 'page' => 1]) ?>"
                           class="collapse-link">Table games</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Action figures", 'page' => 1]) ?>"
                           class="collapse-link">Action figures</a></li>
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
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Home decoration", 'page' => 1]) ?>"
                           class="collapse-link">Home decoration</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Organizers", 'page' => 1]) ?>"
                           class="collapse-link">Organizers</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Bathroom accessories", 'page' => 1]) ?>"
                           class="collapse-link">Bathroom accessories</a></li>
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
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Phone stands", 'page' => 1]) ?>"
                           class="collapse-link">Phone stands</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Laptop stands", 'page' => 1]) ?>"
                           class="collapse-link">Laptop stands</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Headphone stands", 'page' => 1]) ?>"
                           class="collapse-link">Headphone stands</a></li>
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
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Garden accessories", 'page' => 1]) ?>"
                           class="collapse-link">Garden accessories</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Plant pots", 'page' => 1]) ?>"
                           class="collapse-link">Plant pots</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Planters", 'page' => 1]) ?>"
                           class="collapse-link">Planters</a></li>
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
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Desk organizers", 'page' => 1]) ?>"
                           class="collapse-link">Desk organizers</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Monitor stands", 'page' => 1]) ?>"
                           class="collapse-link">Monitor stands</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Cable management", 'page' => 1]) ?>"
                           class="collapse-link">Cable management</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Pen holders", 'page' => 1]) ?>"
                           class="collapse-link">Pen holders</a></li>
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
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Phone holders", 'page' => 1]) ?>"
                           class="collapse-link">Phone holders</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Replacement parts", 'page' => 1]) ?>"
                           class="collapse-link">Replacement parts</a></li>
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
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Fitness equipment", 'page' => 1]) ?>"
                           class="collapse-link">Fitness equipment</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Cycling", 'page' => 1]) ?>"
                           class="collapse-link">Cycling</a></li>
                    <li><a href="<?= $link->url("allPrints.allPrints", ['category' => "Camping gear", 'page' => 1]) ?>"
                           class="collapse-link">Camping gear</a></li>
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
        $rowNum = 0;
        foreach ($data['items'] as $item) {
            $rowNum++; ?>
            <div class="col-md-3">
                <div class="card-sl h-100">
                    <a class="item-page-link" href="<?= $link->url('item.itemProperties', ['id' => $item->getId()]) ?>">
                        <div class="embed-responsive embed-responsive-4by3">
                        <img class="img-fluid card-img-top" alt="product image" src="<?= $item->getPicture() ?>">
                        </div>
                            <div class="card-body">
                            <h3 class="card-title" id="card-title<?=$rowNum?>"><?= $item->getTitle() ?></h3>
                            <p class="card-text">
                                <?= $item->getText() ?>
                            </p>
                            <h3 class="card-prize"><?= strval($item->getPrize()) ?>$</h3>
                        </div>
                    </a>
                    <?php if ($auth->isLogged()) { ?>
                        <button data-bs-container="body" data-bs-toggle="popover"
                                data-bs-trigger="focus"
                                data-bs-custom-class="addCart-popover"
                                data-bs-placement="top" data-bs-content="Item was added to the cart"
                                onclick="addToCart(<?=$item->getId()?>, true, null, null, null, null, null);"
                                class="card-button">Add to cart</button>
                    <?php } else { ?>
                        <button href="#"
                                data-bs-toggle="tooltip"
                                data-bs-custom-class="login-tooltip"
                                data-bs-html="true"
                                data-bs-title="You must <b>login</b> to add thin item to cart"
                                class="card-button">Add to cart
                        </button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<nav>
    <ul class="pagination justify-content-center">
        <?php if ($data['pageNum'] > 1) { ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= $link->url('allPrints.allPrints', ['page' => ($data['pageNum'] - 1), 'search' => $data['search'], 'category' => $data['category'], 'minPrize' => $data['minPrize'], 'maxPrize' => $data['maxPrize']]) ?>"
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo; previous</span>
                </a>
            </li>
        <?php } ?>
        <?php if (!$data['endItems']) { ?>
            <li class="page-item">
                <a class="page-link"
                   href="<?= $link->url('allPrints.allPrints', ['page' => ($data['pageNum'] + 1), 'search' => $data['search'], 'category' => $data['category'], 'minPrize' => $data['minPrize'], 'maxPrize' => $data['maxPrize']]) ?>"
                   aria-label="Next">
                    <span aria-hidden="true">next &raquo;</span>
                </a>
            </li>
        <?php } ?>
    </ul>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</nav>
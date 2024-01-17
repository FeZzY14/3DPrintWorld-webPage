<?php
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public/css/itemPropCSS.css">
<link rel="stylesheet" href="public/css/itemCSS3.css">
<link rel="stylesheet" href="public/css/reviewFormCSS2.css">
<script src="public/js/cartScript3.js"></script>
<script src="public\js\colorExampleScript.js">
</script>
<script>
    let currUser = "<?php echo $auth->isLogged() ? $auth->getLoggedUserName() : '' ?>";

    let id = <?php echo $data['item']->getId() ?>;
</script>
<div class="container item-listing">
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" alt="product image" src="<?= $data['item']->getPicture() ?>">
        </div>
        <div class="col-md-6">
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
                <div class="row selects" id="selects">
                    <label class="form-control-label">Select all options then you can add item to cart</label>
                    <div class="col">
                        <div>
                            <select id="colorSelect" onchange="changeColor(this);onOptionChange();" class="form-select"
                                    aria-label="Default select example">
                                <option class="option" value="Color" selected>Color</option>
                                <option data-descr="color example" class="option" value="#1e1b1b">Black</option>
                                <option data-descr="color example" class="option" value="#d2d0d0">White</option>
                                <option data-descr="color example" class="option" value="#2091b0">Blue</option>
                                <option data-descr="color example" class="option" value="#ef0d40">Red</option>
                                <option data-descr="color example" class="option" value="#1cd220">Green</option>
                                <option data-descr="color example" class="option" value="#b8dc09">Yellow</option>
                            </select>
                        </div>
                        <div class="colorExample" id="colorExample"></div>
                    </div>
                    <div class="col">
                        <select onchange="onOptionChange()" id="materialSelect" class="form-select"
                                aria-label="Default select example">
                            <option selected>Material</option>
                            <option value="PLA">PLA</option>
                            <option value="PETG">PETG</option>
                            <option value="ABS">ABS</option>
                            <option value="ASA">ASA</option>
                            <option value="TPU">TPU</option>
                        </select>
                    </div>
                    <div class="col">
                        <select onchange="onOptionChange()" id="layerSelect" class="form-select"
                                aria-label="Default select example">
                            <option selected>Layer height</option>
                            <option value="0.10">0.10</option>
                            <option value="0.12">0.12</option>
                            <option value="0.15">0.15</option>
                            <option value="0.20">0.20</option>
                            <option value="0.21">0.21</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="bi bi-star-fill ratingAll"><?= $data['rating'] ?></p>
                        <h1 class="prize">
                            <?= $data['item']->getPrize() ?>$
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php if ($auth->isLogged()) { ?>
                            <button data-bs-container="body" data-bs-toggle="popover"
                                    data-bs-trigger="focus" id="cartButton1"
                                    data-bs-custom-class="addCart-popover"
                                    data-bs-placement="top" data-bs-content="Item was added to the cart"
                                    onclick="addToCart(<?= $data['item']->getId() ?>,
                                            false,
                                            document.getElementById('colorSelect').options[document.getElementById('colorSelect').selectedIndex].value,
                                            document.getElementById('materialSelect').options[document.getElementById('materialSelect').selectedIndex].value,
                                            document.getElementById('layerSelect').options[document.getElementById('layerSelect').selectedIndex].value);addToOrder();"
                                    class="card-button">Add to cart
                            </button>
                        <?php } else { ?>
                            <button href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-custom-class="login-tooltip"
                                    data-bs-html="true" id="cartButton0"
                                    data-bs-title="You must <b>login</b> to add thin item to cart"
                                    class="card-button">Add to cart
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($auth->isAdmin()) { ?>
                    <div class="row">
                        <div class="col">
                            <div class="add-button-div">
                                <a href="<?= $link->url("allPrints.printForm", ['id' => $data['item']->getId()]) ?>">
                                    <button class="btn btn-outline-success search-button add-button">Modify
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="add-button-div">
                                <a href="<?= $link->url("allPrints.removePrint", ['id' => $data['item']->getId()]) ?>">
                                    <button class="btn btn-outline-success search-button add-button">Remove
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col>">
            <div class="reviews">
                <h2>Reviews</h2>
                <?php if ($auth->isLogged()) { ?>
                    <button onclick="addReviewButton()" type="button"
                            class="btn add-review" id="add-review">Add review
                    </button>
                    <div class="col-lg-12 login-form" id="review-form">
                        <div class="col-lg-12 login-form">
                            <form class="form-signin" method="dialog"
                                  action="document.getElementById('review-form').classList.toggle('hide')">
                                <div class="form-group">
                                    <div class="rating">
                                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">TEXT</label>
                                    <input type="text" class="form-control" name="text" id="text"
                                           required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">IMAGE(URL)</label>
                                    <input type="url" class="form-control" name="image" id="image">
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-6 login-btm login-text">
                                        <?= @$data['message'] ?>
                                    </div>
                                    <div class="col-lg-6 login-btm login-button" id="add-button-div">
                                        <button value="Toggle" type="submit" class="btn btn-outline-primary"
                                                name="submit" onclick="addReviewForm()" id="reviewButton">add
                                        </button>
                                        <button value="Toggle" type="reset" class="btn btn-outline-primary"
                                                onclick="cleanReviewForm()" id="CancelReviewButton">cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
                 data-bs-smooth-scroll="true"
                 class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0" id="reviews">
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link"
                               onclick="loadMoreReviews()"
                               aria-label="Load-more"
                               id="loadMoreButton">
                                <span aria-hidden="true">&laquo; Load more &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script>

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        onOptionChange();

        function onOptionChange() {
            let addCart1 = document.getElementById("cartButton1");
            let addCart0 = document.getElementById("cartButton0");
            let colorSel = document.getElementById("colorSelect");
            let materialSel = document.getElementById("materialSelect");
            let layerSel = document.getElementById("layerSelect");

            if (colorSel.selectedIndex !== 0 && materialSel.selectedIndex !== 0 && layerSel.selectedIndex !== 0) {
                if (addCart1 !== null) {
                    addCart1.style.display = 'block';
                }
                if (addCart0 !== null) {
                    addCart0.style.display = 'block';
                }
            } else {
                if (addCart1 !== null) {
                    addCart1.style.display = 'none';
                }
                if (addCart0 !== null) {
                    addCart0.style.display = 'none';
                }
            }
        }
    </script>
    <script src="public\js\reviewsScript2.js"></script>
    <script>
    </script>
</div>
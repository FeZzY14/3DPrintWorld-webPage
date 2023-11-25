<?php
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public/css/itemPropCSS2.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<script src="public\js\colorExampleScript.js">
</script>
<script>
    let id = <?php echo $data['item']->getId() ?>;
</script>
<script src="public\js\showMoreReviewsScript.js">
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
                    <div class="col">
                        <div>
                            <select onchange="changeColor(this)" class="form-select"
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
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Material</option>
                            <option value="PLA">PLA</option>
                            <option value="PETG">PETG</option>
                            <option value="ABS">ABS</option>
                            <option value="ASA">ASA</option>
                            <option value="TPU">TPU</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example">
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
                    <div class="col>">
                        <h1 class="prize">
                            <?= $data['item']->getPrize() ?>$
                        </h1>
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
    <div class="row">
        <div class="col>">
            <div class="reviews">
                <h2>Reviews</h2>
                <button type="button" class="btn add-review">Add review</button>
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
</div>
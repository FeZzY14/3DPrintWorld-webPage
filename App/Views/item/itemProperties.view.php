<?php
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public/css/itemPropCSS3.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<link rel="stylesheet" href="public/css/reviewFormCSS2.css">
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
                    <div class="col">
                        <p class="bi bi-star-fill ratingAll"><?= $data['rating']?></p>
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
        document.getElementById('review-form').classList.add('hide');
    </script>
    <script src="public\js\reviewsScript2.js"></script>
    <script>
    </script>
</div>
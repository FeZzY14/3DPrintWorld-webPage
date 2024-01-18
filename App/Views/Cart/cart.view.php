<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/homeCSS.css">
<link rel="stylesheet" href="public/css/itemCSS3.css">
<link rel="stylesheet" href="public/css/cartCSS.css">
<script src="js/bootstrap.bundle.min.js"></script>
<script src="public/js/cartScript2.js"></script>
<div class="home-logo">
    <img class="img-fluid logo_home" src="resources/logo.png" alt="logo image">
</div>
<section class="h-100 h-custom">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="h5">Shopping cart</th>
                            <th scope="col">Title</th>
                            <th scope="col">Color</th>
                            <th scope="col">Material</th>
                            <th scope="col">Layer height</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        <script>
                            let prices = [];
                        </script>
                        <?php
                        for ($i = 0; $i < sizeof($data['prices']); $i++) { ?>
                            <script>
                                prices.push(<?=$data['prices'][$i]?>);
                            </script>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $data['images'][$i] ?>"
                                             class="img-fluid rounded-3 cart-image"
                                             alt="Book">
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <div class="mb-0">
                                        <p class="mb-2"><?= $data['titles'][$i] ?></p>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0"><?= $data['colors'][$i] ?></p>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0"><?= $data['materials'][$i] ?></p>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0"><?= $data['layerHeights'][$i] ?></p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-row">
                                        <input id="qua<?= $i ?>" min="1" name="quantity" value="1" type="number"
                                               class="form-control form-control-sm quantity"
                                               onchange="priceUpdate()"/>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p id="price<?= $i ?>" class="mb-0"><?= $data['prices'][$i] ?></p>
                                </td>
                                <td class="align-middle">
                                    <a href="<?= $link->url("cart.removeOrder", ["id" => $data['ids'][$i]]) ?>"
                                       id="check" type="button"
                                       class="btn btn-primary btn-block btn-lg trash-button">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <?php if (sizeof($data['prices']) != 0) { ?>
                    <button type="button" class="btn btn-primary btn-block btn-lg checkout-button">
                        <span>Order</span>
                        <span id="sumPrice"><?= array_sum($data['prices']) ?></span>
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
        function priceUpdate() {
            let num = <?=sizeof($data['prices'])?>;
            let sum = 0.00;
            console.log(num);
            for (let i = 0; i < num; i++) {
                let quan = document.getElementById(`qua${i}`);
                let price = document.getElementById(`price${i}`);
                let newPrice = quan.value * prices[i];
                sum += newPrice;
                price.innerHTML = newPrice.toFixed(2).toString();
            }
            document.getElementById("sumPrice").innerHTML = sum.toFixed(2).toString();
        }
    </script>
</section>
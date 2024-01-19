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
<link rel="stylesheet" href="public/css/cartCSS8.css">
<script src="js/bootstrap.bundle.min.js"></script>
<script src="public/js/cartScript.js"></script>
<div class="home-logo">
    <i class="bi bi-box2-heart empty-cart"></i>
    <h2>
        Thank you <b><?php $auth->getLoggedUserName()?></b> for your order
    </h2>
    <p class="empty-text">After 5 second you will be redirected to home page.</p>
    <?php
    header('Refresh: 5; ?= $link->url("home.index") ?>');
    ?>

</div>


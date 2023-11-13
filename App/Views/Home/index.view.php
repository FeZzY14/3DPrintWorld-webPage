<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/homeCSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<div class="home-logo">
    <img class="img-fluid logo_home" src="resources/logo.png" alt="logo image">
</div>
<div class="container">
    <div class="row">
        <div class="description">
            <?php if ($data['showMess'] == 1)
                 { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-unlock"></i>
                        You have successfully log in as <strong><?= $auth->getLoggedUserName() ?></strong> have a great time
                        here.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } else if ($data['showMess'] == 2){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-lock"></i>
                        You have successfully log out.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php } else if ($data['showMess'] == 3){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-r-circle"></i>
                    You have successfully registered.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <h1 class="home_welcome">Welcome to 3D Print World</h1>
            Your Destination for Customized 3D Creations<br>
            Are you ready to step into a world where imagination knows no bounds?<br>
            Look no further than 3D Print Haven, your one-stop destination for all things 3D printed.<br>
            We're here to bring your wildest ideas to life, one layer at a time.
            <h2 class="home_welcome">What Sets Us Apart?</h2>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://img.freepik.com/free-photo/designer-using-3d-printer_23-2150942082.jpg?w=1380&t=st=1699354421~exp=1699355021~hmac=9f09693a59a2ac392680a4409d08fcaf5add4ad8a8207ded59d1969f0373f06b"
                         class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caption-title">Endless Possibilities</h5>
                        <p class="caption">Our state-of-the-art 3D printing technology allows us to create a wide array
                            of items,
                            from intricately detailed figurines to functional and customizable parts.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://img.freepik.com/free-photo/person-working-animation-porject_23-2149269904.jpg?w=1380&t=st=1699355687~exp=1699356287~hmac=551e4f95c4d80d569718000a7a205945c3bbb32a254f633e164abc6cb11e86f5"
                         class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caption-title">Customization</h5>
                        <p class="caption">Your ideas are our blueprints. We can turn your unique designs or concepts
                            into tangible objects. You dream it, we print it.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://img.freepik.com/free-photo/designer-working-3d-model_23-2149371848.jpg?w=1380&t=st=1699356296~exp=1699356896~hmac=5b904e1e33c36534793055e8446a402a4160e6149a60588ee531d2fd7dd38e90"
                         class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caption-title">Quality Craftsmanship</h5>
                        <p class="caption">We take pride in the quality of our 3D printed items.
                            Each piece is meticulously crafted to meet the highest standards.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://img.freepik.com/free-photo/saving-money-concept-preset-by-male-hand-putting-money-coin-stack-growing-business-arrange-coins-into-heaps-with-hands-content-about-money_1150-45709.jpg?w=1380&t=st=1699356514~exp=1699357114~hmac=4945c434d37ae03eebfb740a980dfa75445da407a4e3e64cb632c3534b20dc10"
                         class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caption-title">Affordable Pricing</h5>
                        <p class="caption"> Enjoy the benefits of personalized 3D printing without breaking the bank.
                            Our competitive prices make creativity accessible to all.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h2 class="item-type">Featured</h2>
        <?php
        foreach ($data['featured'] as $item) { ?>
            <div class="col-md-4">
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
    <div class="container">
        <div class="row">
            <h2 class="item-type">Popular</h2>
            <?php
            foreach ($data['popular'] as $item) { ?>
                <div class="col-md-4">
                    <div class="card-sl">
                        <a class="item-page-link"
                           href="<?= $link->url('item.itemProperties', ['id' => $item->getId()]) ?>">
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
</div>
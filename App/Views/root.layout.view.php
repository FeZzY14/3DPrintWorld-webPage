<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\Router $router */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/layoutCSS.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <img class="navbar-brand" src="resources/logo2.png" alt="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse"
                aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navBar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="<?php if ($_SERVER['REQUEST_URI'] == "/?c=home") { ?>nav-link active<?php } else { ?>nav-link<?php } ?>"
                       href="<?= $link->url("home.index") ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if (str_starts_with($_SERVER['REQUEST_URI'], "/?c=allPrints")) { ?>nav-link active<?php } else { ?>nav-link<?php } ?>"
                       href="<?= $link->url("allPrints.allPrints", ['page' => 1]) ?>">All prints</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($_SERVER['REQUEST_URI'] == "/?c=home&a=customPrint") { ?>nav-link active<?php } else { ?>nav-link<?php } ?>"
                       href="<?= $link->url("home.customPrint") ?>">custom print</a>
                </li>
                <li class="nav-item">
                    <a class="<?php if ($_SERVER['REQUEST_URI'] == "/?c=home&a=about") { ?>nav-link active<?php } else { ?>nav-link<?php } ?>"
                       href="<?= $link->url("home.about") ?>">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if ($auth->isLogged()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $link->url("auth.login") ?>">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link register" href="<?= $link->url("auth.logout") ?>">logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.google.com">
                            <i class="bi bi-cart"></i>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $link->url("auth.login") ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link register" href="<?= $link->url("auth.register") ?>">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.google.com">
                            <i class="bi bi-cart"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
<div>
    <?= $contentHTML ?>
    <footer class="footer-nav text-center text-lg-start text-white ">
        <div class="container p-4 pb-0 ">
            <section class="">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6>
                            3D Print World
                        </h6>
                        <p>
                            <img class="footer-logo" src="resources/logo2.png" alt="logo">
                        </p>
                    </div>
                    <hr class="w-100 clearfix d-md-none"/>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6>Information</h6>
                        <p>
                            <a href="" class="footer-txt">Shipping</a>
                        </p>
                        <p>
                            <a href="" class="footer-txt">Payment</a>
                        </p>
                        <p>
                            <a href="" class="footer-txt">Private policy</a>
                        </p>
                        <p>
                            <a href="" class="footer-txt">Term and Conditions</a>
                        </p>
                    </div>
                    <hr class="w-100 clearfix d-md-none"/>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6>Contact</h6>
                        <p><i class="fas fa-home mr-3"></i> San Diego, CA 1875 Carriage Court, US</p>
                        <p><i class="fas fa-envelope mr-3"></i> 3DPrWorld@gmail.com</p>
                        <p><i class="fas fa-phone mr-3"></i> 760-420-5023</p>
                        <p><i class="fas fa-print mr-3"></i> 619-548-6452</p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6>Follow us</h6>
                        <a
                                class="footer-btn btn btn-primary btn-floating m-1"
                                style="background-color: #3b5998"
                                href="https://www.facebook.com/"
                                role="button"
                        ><i class="bi bi-facebook"></i
                            ></a>
                        <a
                                class="footer-btn btn btn-primary btn-floating m-1"
                                style="background-color: #000000"
                                href="https://twitter.com/"
                                role="button"
                        ><i class="bi bi-twitter-x"></i
                            ></a>
                        <a
                                class="footer-btn btn btn-primary btn-floating m-1"
                                style="background-color: #dd4b39"
                                href="https://sk.wikipedia.org/wiki/Google%2B"
                                role="button"
                        ><i class="bi bi-google"></i
                            ></a>
                        <a
                                class="footer-btn btn btn-primary btn-floating m-1"
                                style="background-color: #ac2bac"
                                href="https://www.instagram.com/"
                                role="button"
                        ><i class="bi bi-instagram"></i
                            ></a>
                        <a
                                class="footer-btn btn btn-primary btn-floating m-1"
                                style="background-color: #0082ca"
                                href="https://www.linkedin.com/"
                                role="button"
                        ><i class="bi bi-linkedin"></i
                            ></a>
                        <a
                                class="footer-btn btn btn-primary btn-floating m-1"
                                style="background-color: #333333"
                                href="https://github.com/"
                                role="button"
                        ><i class="bi bi-github"></i
                            ></a>
                    </div>
                </div>
            </section>
        </div>
        <div class="copy text-center p-3">
            © 2023 Copyright:
            <a class="text-white" href="https://youtube.com/"
            >3DPrintWorld.com</a>
        </div>
    </footer>
</div>
</body>
</html>

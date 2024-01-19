<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>
<link rel="stylesheet" href="public/css/loginCSS.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="container login">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="bi bi-lock" aria-hidden="true"></i>
            </div>
            <div class="col-lg-12 login-title">
                Login
            </div>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form class="form-signin" method="post" action="<?= $link->url("login") ?>">
                        <div class="form-group">
                            <label class="form-control-label">LOGIN</label>
                            <input aria-label="form-control-label" type="text" class="form-control" name="login" id="login"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">PASSWORD</label>
                            <input aria-label="form-control-label" type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6 login-btm login-text">
                                <?= @$data['message'] ?>
                            </div>
                            <div class="register-text">
                                Not registered ? <a class="register-link" href="<?= $link->url("register") ?>">register
                                    here</a>
                            </div>
                            <div class="col-lg-6 login-btm login-button">
                                <button type="submit" class="btn btn-outline-primary" name="submit">LOGIN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
</div>





<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
/**@var App\Models\Item $item */
?>
<link rel="stylesheet" href="public/css/printFormCSS2.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    let category = "<?php if ($data['item'] != null) { echo $data['item']->getCategory(); } else {echo "";} ?>";
</script>
<div class="container login">
    <div class="row">
        <div class="col-lg-3 col-md-2"></div>
        <div class="col-lg-6 col-md-8 login-box">
            <div class="col-lg-12 login-key">
                <i class="bi bi-journal-text" aria-hidden="true"></i>
            </div>
            <div class="col-lg-12 login-title">
                Print properties
            </div>
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form class="form-signin" method="post" action="<?= $data['item'] != null ? $link->url("modifyPrint",['id' => $data['item']->getId()]) : $link->url("printForm")?>">
                        <div class="form-group">
                            <label class="form-control-label">TITLE</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php if ($data['item'] != null) { echo $data['item']->getTitle(); } else {echo '';} ?>"
                                   required autofocus>
                        </div>
                        <select name="category" id="category" class="form-select" aria-label="Default select example">
                            <option selected>Category</option>
                            <option value="0.10">0.10</option>
                            <option value="Cable management">Cable management</option>
                            <option value="others">Others</option>
                            <option value="Cycling">Cycling</option>
                            <option value="Camping gear">Camping gear</option>

                        </select>
                        <div class="form-group">
                            <label class="form-control-label">IMAGE(URL)</label>
                            <input type="url" class="form-control" name="image" id="image" required
                                   value="<?php if ($data['item'] != null) { echo $data['item']->getPicture(); } else {echo '';} ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">DESCRIPTION</label>
                            <textarea rows="5" type="text" class="form-control" name="description" id="description" required ><?php
                                if ($data['item'] != null) { echo htmlspecialchars($data['item']->getText()); } else {echo '';}
                                ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">PRIZE</label>
                            <input type="number" step="0.01" min="0.01" class="form-control" name="prize" id="prize" required
                                   value="<?php if ($data['item'] != null) { echo $data['item']->getPrize(); } else {echo '';} ?>">
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-6 login-btm login-text">
                                <?= @$data['message'] ?>
                            </div>
                            <div class="col-lg-6 login-btm login-button">
                                <button type="submit" class="btn btn-outline-primary" name="submit">ADD</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
    <script>
        if (category.length !== 0) {
            console.log(category);
            document.getElementById('category').value = category;
        }
    </script>







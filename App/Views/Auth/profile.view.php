<?php
/** @var Array $data */
/** @var App\Models\UserItem $item */
/** @var App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public/css/itemPropCSS.css">
<link rel="stylesheet" href="public/css/userItemCSS.css">
<link rel="stylesheet" href="public/css/customPrintCSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<script src="public/js/cartScript.js"></script>
<script src="public\js\colorExampleScript.js"></script>
<!--https://www.viewstl.com/plugin/#intro
Viewstl Javscript plugin is licensed under the MIT License - Copyright (c) 2019 Viewstl.com-->
<script src="public/js/stlViewer/three.min.js"></script>
<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script>
<script src="public/js/stlViewer/webgl_detector.js"></script>
<script src="public/js/stlViewer/Projector.js"></script>
<script src="public/js/stlViewer/CanvasRenderer.js"></script>
<script src="public/js/stlViewer/OrbitControls.js"></script>
<script src="public/js/stlViewer/TrackballControls.js"></script>
<script src="public/js/stlViewer/ie_polyfills.js"></script>
<script src="public/js/stlViewer/parser.min.js"></script>
<script src="public/js/stlViewer/load_stl.min.js"></script>
<script>
    let userId = <?php echo $auth->getLoggedUserId() ?>;
    let count = <?php echo count($data['items']); ?>;
</script>
<!--------------------------------------------------------------->
<div class="container item-listing">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="title">Your saved prints</h2>
        </div>
    </div>
    <script src="public/js/stlViewer/stl_viewer.min.js"></script>
    <?php
    $i = 0;
    foreach ($data['items'] as $item) { ?>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card-sl">
                    <div id="stl_cont<?= $i ?>" style="width:100%;height:400px;">
                    </div>
                    <?php
                    $file = 'public/js/stlViewer/file' . $i . '.' . $item->getFileType();
                    file_put_contents($file, $item->getFile()); ?>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-title" id="cardTitle<?= $i ?>"><?= $item->getFileName() ?></h3>
                                    <p class="card-text">
                                        <label class="form-control-label">color:</label> <?= $item->getColor() ?><br>
                                        <label class="form-control-label">material:</label> <?= $item->getMaterial() ?>
                                        <br>
                                        <label class="form-control-label">layer
                                            height:</label> <?= $item->getLayerHeight() ?>
                                    </p>
                                </div>
                                <div class="col">
                                    <a class="btn btn-outline-success search-button add-button"
                                       href="<?= $link->url("removeUserItem", ['id' => $item->getId()]) ?>">
                                        Delete
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h3 class="card-prize" id="cardPrize<?= $i ?>"><?= $item->getPrize() == null ? '-' : $item->getPrize(); ?>$</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($auth->isLogged()) { ?>
                        <button data-bs-container="body" data-bs-toggle="popover"
                                data-bs-trigger="focus"
                                data-bs-custom-class="addCart-popover"
                                data-bs-placement="top" data-bs-content="Item was added to the cart"
                                onclick="addToCart(<?=$item->getId()?>, false, null, null, null, null, null);"
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
        </div>
        <?php $i++;
    } ?>
    <?php if (count($data['items']) == 0) { ?>
        <div class="noPrints">
            <div>
                <div>
                    <i class="bi bi-ban noPrintsIcon"></i>
                    <h2>
                        No saved prints
                    </h2>
                </div>
            </div>
        </div>
    <?php } ?>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        const colors = [];
        const types = [];
        let k = 0;
        <?php $i = 0;
        foreach ($data['items'] as $item) { ?>
        colors[k] = "<?= $item->getColor() ?>";
        types[k] = "<?= $item->getFileType() ?>";
        k++;
        <?php } ?>

        const viewers = [];
        for (let i = 0; i < count; i++) {
            viewers[i] = new StlViewer
            (
                document.getElementById(`stl_cont${i}`),
                {
                    models: [
                        {filename: `file${i}.${types[i]}`, color: colors[i]}
                    ],
                    auto_rotate: true,
                    allow_drag_and_drop: true
                }
            );
        }
    </script>
</div>
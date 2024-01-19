<?php
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public/css/itemPropCSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<link rel="stylesheet" href="public/css/customPrintCSS.css">
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
</script>
<!--------------------------------------------------------------->
<div class="container item-listing">
    <div class="row">
        <?php if ($data['showMess'] == 1)
        { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-floppy"></i>
                <strong><?= $auth->getLoggedUserName() ?></strong> your print was successfully saved to your profile
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <div class="col-md-6">
            <div id="stl_cont" style="width:100%;height:500px;">
            </div>
            <script src="public/js/stlViewer/stl_viewer.min.js"></script>
            <script>
                var stl_viewer = new StlViewer
                (
                    document.getElementById("stl_cont"),
                    {
                        auto_rotate: true,
                        allow_drag_and_drop: true
                    }
                );
            </script>
        </div>
        <div class="col-md-6">
            <form enctype="multipart/form-data" class="form-signin" method="POST" action="<?= $link->url("savePrint",['userId' => $auth->getLoggedUserId()]) ?>">
                <div class="container">
                    <div class="row">
                        <div class="col>">
                            <h2>Custom print</h2>
                        </div>
                        <div class="col>">
                            <div>
                                <div class="form-group">
                                    <label class="form-control-label">Select file(STL/OBJ)</label>
                                    <input type="file" class="form-control" name="file" id="file" size="1"
                                           accept=".stl,.obj"
                                           onchange="stl_viewer.clean();stl_viewer.add_model({local_file:this.files[0], color:document.getElementById('colorSelect').options[document.getElementById('colorSelect').selectedIndex].value});onOptionChange()">
                                </div>
                                <label class="form-control-label">Select all options then you can calculate the
                                    price</label>
                            </div>
                        </div>
                    </div>
                    <div class="row selects" id="selects">
                        <div class="col">
                            <div>
                                <select onchange="changeColor(this);onOptionChange()" class="form-select"
                                        aria-label="Default select example" id="colorSelect" name="color">
                                    <option class="option" value="#e39774" selected>Color</option>
                                    <option data-descr="color example" class="option" value="#1e1b1b">Black</option>
                                    <option data-descr="color example" class="option" value="#d2d0d0">White</option>
                                    <option data-descr="color example" class="option" value="#2091b0">Blue</option>
                                    <option data-descr="color example" class="option" value="#ef0d40">Red</option>
                                    <option data-descr="color example" class="option" value="#1cd220">Green</option>
                                    <option data-descr="color example" class="option" value="#b8dc09">Yellow</option>
                                </select>
                            </div>
                            <div class="colorExample" id="colorExample">
                            </div>
                        </div>
                        <div class="col">
                            <select onchange="onOptionChange()" class="form-select" aria-label="Default select example"
                                    id="materialSelect" name="material">
                                <option selected>Material</option>
                                <option value="PLA">PLA</option>
                                <option value="PETG">PETG</option>
                                <option value="ABS">ABS</option>
                                <option value="ASA">ASA</option>
                                <option value="TPU">TPU</option>
                            </select>
                        </div>
                        <div class="col">
                            <select onchange="onOptionChange()" class="form-select" aria-label="Default select example"
                                    id="layerSelect" name="layer">
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
                            <div class="calculate-button-div">
                                <button onclick="calculatePrize()"
                                        class="btn btn-outline-success search-button calculate-button"
                                        id="calculateButton" type="button">
                                    Calculate price
                                </button>
                            </div>
                        </div>
                        <?php if ($auth->isLogged()) { ?>
                            <div class="col">
                                <div class="calculate-button-div">
                                    <a id="a2">
                                        <button type="submit" name="submit"
                                                class="btn btn-outline-success search-button calculate-button"
                                                id="saveButton">Save print
                                        </button>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="prize"></label>
                            <input class="prize" id="prize" value="-$" name="prize" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="cartButton">
                            <?php if ($auth->isLogged()) { ?>
                                <button data-bs-container="body" data-bs-toggle="popover"
                                        type="button"
                                        data-bs-trigger="focus" id="cartButton1"
                                        data-bs-custom-class="addCart-popover"
                                        data-bs-placement="top" data-bs-content="Item was added to the cart"
                                        onclick="addToCart(null,
                                                false,
                                                document.getElementById('colorSelect').options[document.getElementById('colorSelect').selectedIndex].value,
                                                document.getElementById('materialSelect').options[document.getElementById('materialSelect').selectedIndex].value,
                                                document.getElementById('layerSelect').options[document.getElementById('layerSelect').selectedIndex].value,
                                                parseFloat(document.getElementById('prize').value.slice(0, -1)),
                                                document.getElementById('file').files[0].name);"
                                        class="card-button">Add to cart
                                </button>
                            <?php } else { ?>
                                <button data-bs-toggle="tooltip"
                                        type="button"
                                        data-bs-custom-class="login-tooltip"
                                        data-bs-html="true" id="cartButton0"
                                        data-bs-title="You must <b>login</b> to add thin item to cart"
                                        class="card-button" disabled>Add to cart
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="public\js\customPrintScript.js"></script>
</div>
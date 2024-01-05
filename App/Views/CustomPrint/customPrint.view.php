<?php
/** @var Array $data */
/** @var App\Models\Item $item */
/** @var App\Core\LinkGenerator $link */
/** @var App\Core\IAuthenticator $auth */
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="public/css/itemPropCSS.css">
<link rel="stylesheet" href="public/css/itemCSS.css">
<link rel="stylesheet" href="public/css/customPrintCSS4.css">
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
                                    <script>
                                        const fileInput = document.getElementById("file");
                                        const myFile = new File([''], 'Default.obj', {
                                            type: 'obj',
                                            lastModified: new Date(),
                                        });
                                        const dataTransfer = new DataTransfer();
                                        dataTransfer.items.add(myFile);
                                        fileInput.files = dataTransfer.files;
                                    </script>
                                </div>
                                <label class="form-control-label">Select all options then you can calculate the
                                    prize</label>
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
                                    Calculate prize
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
                            <a href="http://www.bing.com" class="card-button item-page">add to cart</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        let saveButt = document.getElementById("saveButton");
        let calculateButt = document.getElementById("calculateButton");
        let cartButt = document.getElementById("cartButton");
        if (saveButt !== null) {
            saveButt.style.display = 'none';
            document.getElementById("a2").style.textDecoration = 'none';
        }
        calculateButt.style.display = 'none';
        cartButt.style.display = 'none';

        function onOptionChange() {
            let fileSel = document.getElementById("file");
            let colorSel = document.getElementById("colorSelect");
            let materialSel = document.getElementById("materialSelect");
            let layerSel = document.getElementById("layerSelect");
            let prizeText = document.getElementById("prize");

            if (fileSel.files.length !== 0 && colorSel.selectedIndex !== 0 && materialSel.selectedIndex !== 0 && layerSel.selectedIndex !== 0) {
                calculateButt.style.display = 'block';
                prizeText.value = "-$";
                cartButt.style.display = 'none';
                if (saveButt !== null) {
                    saveButt.style.display = 'none';
                }
            } else {
                calculateButt.style.display = 'none';
                cartButt.style.display = 'none';
                prizeText.value = "-$";
                cartButt.style.display = 'none';
                if (saveButt !== null) {
                    saveButt.style.display = 'none';
                }
            }

            stl_viewer.set_color(1, colorSel.options[colorSel.selectedIndex].value);
        }

        function calculatePrize() {
            let size = document.getElementById("file").files[0].size;
            let prize;
            let materialSel = document.getElementById("materialSelect");
            let layerSel = document.getElementById("layerSelect");

            switch (materialSel.selectedIndex) {
                case 1:
                    prize = size / 200;
                    break;
                case 2:
                    prize = size / 150;
                    break;
                case 3:
                    prize = size / 120;
                    break;
                case 4:
                    prize = size / 120;
                    break;
                case 5:
                    prize = size / 100;
                    break;
            }

            switch (layerSel.selectedIndex) {
                case 1:
                    prize = prize / 100;
                    break;
                case 2:
                    prize = prize / 120;
                    break;
                case 3:
                    prize = prize / 130;
                    break;
                case 4:
                    prize = prize / 150;
                    break;
                case 5:
                    prize = prize / 200;
                    break;
            }
            if (size === 0) {
                prize = 0.01;
            }

            let prizeText = document.getElementById("prize");
            prizeText.value = prize.toFixed(2) + "$";
            cartButt.style.display = 'block';
            if (saveButt !== null) {
                saveButt.style.display = 'block';
            }
        }

        function savePrint() {
            let file = document.getElementById("file").files[0];
            let fileBlob = new Blob([file], {type: ".stl,.obj"});
            let fileName = file.name;
            let colorSel = document.getElementById("colorSelect");
            let color = colorSel.options[colorSel.selectedIndex].value;
            let materialSel = document.getElementById("materialSelect");
            let material = materialSel.options[materialSel.selectedIndex].value;
            let layerSel = document.getElementById("layerSelect");
            let layer = layerSel.options[layerSel.selectedIndex].value;

            let url = `http://localhost/index.php?userId=${userId}&c=customPrint&a=savePrint`;
            let request = new XMLHttpRequest();
            request.onload = function () {
                //let data = JSON.parse(request.responseText);
                console.log(44);
            };
            request.open("POST", url)
            request.send();
        }
    </script>
</div>
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
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
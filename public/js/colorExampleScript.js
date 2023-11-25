function changeColor(wrapDiv) {
    let innerSelect = wrapDiv;
    let selectedOption = innerSelect.options[innerSelect.selectedIndex];
    let colorExample = document.getElementById('colorExample');
    colorExample.innerHTML = selectedOption.getAttribute('data-descr');
    if (selectedOption.value === "#1e1b1b") {
        colorExample.style.backgroundColor = selectedOption.value;
        colorExample.style.color = "white";
    } else {
        colorExample.style.backgroundColor = selectedOption.value;
    }
    if (colorExample.innerHTML !== '' || colorExample.innerHTML === 'Color') {
        document.getElementById('selects').style.paddingBottom = "6px";
    } else {
        colorExample.style.backgroundColor = "white";
        document.getElementById('selects').style.paddingBottom = "30px";
    }
}
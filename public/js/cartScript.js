function addToCart(itemId, def, color, material, layerHeight) {
    console.log(color);
    let url
    if (def) {
        let defColor = "#1e1b1b";
        let defMaterial = "PLA";
        let defLayerHeight = "0.20";
        url = `http://localhost/index.php?itemId=${itemId}&color=${defColor}&material=${defMaterial}&layerHeight=${defLayerHeight}&c=cart&a=addToCart`;
    } else if (!def) {
        url = `http://localhost/index.php?itemId=${itemId}&color=${color}&material=${material}&layerHeight=${layerHeight}&c=cart&a=addToCart`;
    }
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        document.getElementById("menuCartIcon").innerText = data.length;
        document.getElementById("menuCartIcon").backgroundColor = "#e39774";
        console.log(data);

        for (let i = 0; i < data.length; i++) {
            console.log(data[i]);

        }
    };
    request.open("GET", url)
    request.send();
}
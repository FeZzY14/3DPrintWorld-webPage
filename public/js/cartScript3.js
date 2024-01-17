function addToCart(itemId, def, color, material, layerHeight) {
    console.log(itemId);
    let url
    let id
    if (def) {
        let defColor = "1e1b1b";
        let defMaterial = "PLA";
        let defLayerHeight = "0.20";
        url = `http://localhost/?&itemId=${itemId.toString()}&color=${defColor}&material=${defMaterial}&layerHeight=${defLayerHeight}&c=cart&a=addToCart`;
    } else if (!def) {
        url = `http://localhost/?&itemId=${itemId.toString()}&color=${color.substring(1)}&material=${material}&layerHeight=${layerHeight}&c=cart&a=addToCart`;
    }
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        document.getElementById("menuCartIcon").innerText = `${data.length}`;
        document.getElementById("menuCartIcon").color = "#e39774";
        console.log(data);
        id = data[data.length - 1].id;
        console.log(id);
    };
    request.open("GET", url)
    request.send();
}

function addToOrder() {
    let url = `http://localhost/?&c=cart&a=addToOrder`;
    let request = new XMLHttpRequest();
    request.onload = function () {
        console.log(request.responseText);
        let data = JSON.parse(request.responseText);
    };
    request.open("GET", url)
    request.send();
}
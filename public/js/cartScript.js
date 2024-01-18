function addToCart(itemId, def, color, material, layerHeight, price, title) {
    console.log(itemId);
    let url
    let id
    if (def && itemId !== null) {
        let defColor = "1e1b1b";
        let defMaterial = "PLA";
        let defLayerHeight = "0.20";
        url = `http://localhost/?&itemId=${itemId.toString()}&color=${defColor}&material=${defMaterial}&layerHeight=${defLayerHeight}&c=cart&a=addToCart`;
    } else if (!def && itemId !== null && color !== null && material !== null && layerHeight !== null && price === null) {
        url = `http://localhost/?&itemId=${itemId.toString()}&color=${color.substring(1)}&material=${material}&layerHeight=${layerHeight}&c=cart&a=addToCart`;
    } else if (itemId === null) {
        url = `http://localhost/?&color=${color.substring(1)}&material=${material}&layerHeight=${layerHeight}&price=${price}&title=${title}&c=cart&a=addToCart`;
    } else if (itemId !== null && !def && color === null && material === null && layerHeight === null && price === null) {
        url = `http://localhost/?&itemId=${itemId.toString()}&c=cart&a=addToCart`;
    }
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        document.getElementById("menuCartIcon").innerText = `${data.length}`;
        document.getElementById("menuCartIcon").color = "#e39774";
        console.log(data);
        id = data[data.length - 1].id;
        addToOrder();
    };
    request.open("GET", url)
    request.send();
}

function addToOrder() {
    let url = `http://localhost/?&c=cart&a=addToOrder`;
    let request = new XMLHttpRequest();
    console.log("order please");
    request.onload = function () {
        console.log(request.responseText);
        let data = JSON.parse(request.responseText);
    };
    request.open("GET", url)
    request.send();
}
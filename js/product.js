pickColor = (e) => {
    var eid = e.getAttribute("id");
    var splitId = eid.split("_");
    var splitIdLen = splitId.length;
    var color = splitId[splitIdLen - 1];
    var productId = splitId[splitIdLen - 2];
    var imageName = document.getElementById(splitId[0] + "_img_" + productId);
    imageName.src = "./pics/" + productId + "_" + color + ".jpg";
}

initProductImage = (button_id) => {
    var e = document.getElementById(button_id);
    pickColor(e);
}

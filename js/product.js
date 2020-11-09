pickColor = (e) => {
    var splitName = e.getAttribute("id").split("_");
    var len = splitName.length;
    var productId = splitName[len - 2];
    var color = splitName[len - 1];
    var imageName = document.getElementById(splitName[0] + "_img_" + productId);
    imageName.src = "./pics/" + productId + "_" + color + ".jpg";
}

fetchImg = (button_id) => {
    pickColor(document.getElementById(button_id));
}

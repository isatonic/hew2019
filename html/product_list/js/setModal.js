function setModal(elem) {
    const clickedID = elem.id;
    const urlPre = "../Upload/images/";
    let
        thumbnail = document.getElementById("detail-thumbnail"),
        title = document.getElementById("detail-title"),
        comment = document.getElementById("detail-comment"),
        price = document.getElementById("detail-price"),
        button = document.getElementById("cartButton")
    ;

    let targetRow = phpjson.findIndex(function(element) {
        return element.indexOf(clickedID) >= 0;
    });

    thumbnail.src = urlPre + phpjson[targetRow]["fileName"];
    title.innerHTML = phpjson[targetRow]["title"];
    comment.innerHTML = phpjson[targetRow]["authorComment"];
    price.innerHTML = "販売金額: " + phpjson[targetRow]["price"] + "P";
    let newFunc = "addCart(" + phpjson[targetRow]["id"] + ");";
    button.onclick = new Function(newFunc);
}


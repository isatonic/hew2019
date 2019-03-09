function setModal(file_name) {
    const clickedFile = file_name;
    const urlPre = "../uploaded_files/";
    let
        thumbnail = document.getElementById("detail-thumbnail"),
        title = document.getElementById("detail-title"),
        comment = document.getElementById("detail-comment"),
        price = document.getElementById("detail-price"),
        button = document.getElementById("cartButton")
    ;

    // let targetRow = phpjson.findIndex(function(element) {
    //     return element.indexOf(clickedSrc) >= 0;
    // });
    let targetRow;
    for (let i = 0; i < phpjson.length; i++) {
        if (phpjson[i].fileName === clickedFile) {
             targetRow = i;
             break;
        }
    }

    thumbnail.src = urlPre + phpjson[targetRow]["fileName"];
    title.innerHTML = phpjson[targetRow]["title"];
    comment.innerHTML = phpjson[targetRow]["authorComment"];
    price.innerHTML = "販売金額: " + phpjson[targetRow]["price"] + "TP";
    // let newFunc = "addCart(" + phpjson[targetRow]["id"] + ");";
    button.value = phpjson[targetRow]["id"];
}


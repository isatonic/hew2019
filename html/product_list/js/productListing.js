Object.keys(phpjson).forEach(function (key) {
    let row = `<div onclick="setModal(this);" class="product-container"><amp-img id="${phpjson[key]['id']}" class="product openModal" layout="fill" src="../Upload/images/${phpjson[key]['fileName']}" alt=""></amp-img></div>`;
    document.write(row);
});

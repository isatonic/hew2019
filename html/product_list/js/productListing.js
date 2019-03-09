Object.keys(phpjson).forEach(function (key) {
    let row = `<div class="product-container"><amp-img onclick="setModal(this.id);" id="${phpjson[key]['fileName']}" class="product openModal" layout="fill" src="../uploaded_files/${phpjson[key]['fileName']}" alt=""></amp-img></div>`;
    document.write(row);
});

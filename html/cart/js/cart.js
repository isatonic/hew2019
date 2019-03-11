function submit_itemsGO() {
    var target = document.getElementById("form301");
    target.method = "post";
    target.submit();

}

function buybuy_items() {
    if (window.confirm("購入を実行します。\nよろしいですか？")) {
        var target = document.getElementById("form401");
        target.method = "post";
        target.submit();
    }
}

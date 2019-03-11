$('#user_search_button').on('click', function(){
    // $('#result').text('通信中...');
    // Ajax通信を開始
    $.ajax({
        url: '../controller/user_search.php',
        type: 'POST',
        dataType: 'json',
        // フォーム要素の内容をJSON文字列に変換
        data: $('#user_search_form').serializeArray(),
        timeout: 5000,
    })
        .done(function(data) {
            // 通信成功時の処理を記述
        })
        .fail(function() {
            // 通信失敗時の処理を記述
        });
});
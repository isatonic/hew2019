function addCart(value) {

    let form = document.createElement('form');
    let request = document.createElement('input');

    form.method = 'POST';
    form.action = '../controller/addCart.php';

    request.type = 'hidden'; //入力フォームが表示されないように
    request.name = 'product';
    request.value = value;

    form.appendChild(request);
    document.body.appendChild(form);

    form.submit();

}

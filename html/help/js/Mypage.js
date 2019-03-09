//プロフィール設定・変更
$(function () {
  $('#openModal').click(function(){
      $('#modalArea').fadeIn();
  });
  $('#closeModal , #modalBg').click(function(){
    $('#modalArea').fadeOut();
  });
});



//パスワード変更
$(function () {
  $('#openModal2').click(function(){
      $('#modalArea2').fadeIn();
  });
  $('#closeModal , #modalBg2').click(function(){
    $('#modalArea2').fadeOut();
  });
});




										//パスワード入力チェック
										function check(){ 
											var flag = 0
											if(document.form1.pass_old.value == ""){ 
												flag = 1;
											}
											else if(document.form1.pass_new.value == ""){
												flag = 1;
											}	
											else if(document.form1.pass_new2.value == ""){
												flag = 1;
											}
											if(flag){
												window.alert('必須項目に未入力がありました'); // 入力漏れがあれば警告ダイアログを表示
												return false; // 送信を中止
											}
											else{
												check2();
												}
										}
										$(function check2() {
											var target1 = document.form1.pass_new.value;
											var target2 = document.form1.pass_new2.value;

											if(target1 != target2){
												// 完全一致のときの処理
												var target = document.getElementById("form1");
												target.method = "post";
												target.submit();
											}
											else{
												window.alert('入力したパスワードが一致しません'); // パスワード違いがあれば警告ダイアログを表示
												return false; // 送信を中止
											}
										});
										function CheckPassword(confirm){
												// 入力値取得
												var input1 = password.value;
												var input2 = confirm.value;
												// パスワード比較
												if(input1 != input2){
													confirm.setCustomValidity("入力値が一致しません。");
												}else{
												var target = document.getElementById("form1");
												target.method = "post";
												target.submit();
												}
											}






//投稿作品一覧
$(function () {
  $('#openModal3').click(function(){
      $('#modalArea3').fadeIn();
  });
  $('#closeModal , #modalBg3').click(function(){
    $('#modalArea3').fadeOut();
  });
});



//購入作品一覧
$(function () {
  $('#openModal4').click(function(){
      $('#modalArea4').fadeIn();
  });
  $('#closeModal , #modalBg4').click(function(){
    $('#modalArea4').fadeOut();
  });
});



//売上確認
$(function () {
  $('#openModal5').click(function(){
      $('#modalArea5').fadeIn();
  });
  $('#closeModal , #modalBg5').click(function(){
    $('#modalArea5').fadeOut();
  });
});



//退会
$(function () {
  $('#openModal6').click(function(){
      $('#modalArea6').fadeIn();
  });
  $('#closeModal , #modalBg6 , .down_the_button').click(function(){
    $('#modalArea6').fadeOut();
  });
});

//退会再確認
$(function () {
	$('#openModal7').click(function(){
		$('#modalArea7').fadeIn();
	});
	$('#closeModal2 , #modalBg7 , .down_the_button2').click(function(){
		$('#modalArea7').fadeOut();
	});
});




																								//US17-18

//送信_2
function submiiiit_s(){
	var target = document.getElementById("form001");
	target.method = "post";
	target.submit();
}
 
										//入力チェック
										function check_sub(){ 
											var flag = 0
											if(document.form1.name_s.value == ""){
												flag = 1;
											}
											else if(document.form1.name_m.value == ""){
												flag = 1;
											}
											else if(document.form1.mail.value == ""){
												flag = 1;
											}	
											else if(document.form1.mail2.value == ""){
												flag = 1;
											}
											else if(document.form1.title.value == ""){
												flag = 1;
											}
											else if(document.form1.main_text.value == ""){
												flag = 1;
											}
											if(flag){
												window.alert('必須項目に未入力がありました');
												return false; // 送信を中止
											}
											else{
												check3();
											}
										}
										function check3() {
											var target1 = document.form1.mail.value;
											var target2 = document.form1.mail2.value;

											if(target1 === target2){
												// 完全一致のときの処理
													var target = document.getElementById("form001");
													target.method = "post";
													target.submit();
												}
											else{
												window.alert('入力したメールアドレスが一致しません'); //メールアドレス違いがあれば警告ダイアログを表示
												return false; // 送信を中止
											}
										}
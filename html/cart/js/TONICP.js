//戻る
function back(){
	history.back();
	 window.location.reload();
}

//入力チェック
function check(){ 
	var flag = 0
	if(document.form1.cre1.value == ""){ //クレジットカード番号
		flag = 1;
	}
	else if(document.form1.cre2.value == ""){
		flag = 1;
	}
	else if(document.form1.cre3.value == ""){
		flag = 1;
	}	
	else if(document.form1.samplecredit.value == ""){
		flag = 1;
	}
	else if(document.form1.pointtp.value == ""){ //ポイント数選択
		flag = 1;
	}
	else if(document.form1.cre11.value == ""){ //クレジットカード有効期限
		flag = 1;
	}
	else if(document.form1.cre12.value == ""){
		flag = 1;
	}
	else if(document.form1.cresequ.value == ""){ //クレジットカードのセキュリティコード
		flag = 1;
	}
	if(flag){
		window.alert('必須項目に未入力がありました'); // 入力漏れがあれば警告ダイアログを表示
		return false; // 送信を中止
	}
	else{
		var target = document.getElementById("form01");
		target.method = "post";
		target.submit();
	}
}

//ポイント数選択
function get1(){
  document.getElementById("count").innerText = "100";
	$("#count").val("100");
}
function get2(){
  document.getElementById("count").innerText = "500";
	$("#count").val("500");
}
function get3(){
  document.getElementById("count").innerText = "1000";
	$("#count").val("1000");
}
function get4(){
  document.getElementById("count").innerText = "2000";
	$("#count").val("2000");
}
function get5(){
  document.getElementById("count").innerText = "5000";
	$("#count").val("5000");
}

//ローディング
$(function() {
  var h = $(window).height();
 
  $('#wrap').css('display','none');
  $('#loader-bg ,#loader').height(h).css('display','block');
});
 
$(window).load(function () { //消えて出てくるやつ（Buying................）
  $('#loader-bg').fadeOut(4000);
  $('#loader').fadeOut(4000);
  $('#wrap').hide().delay(2500).fadeIn(1000);
});

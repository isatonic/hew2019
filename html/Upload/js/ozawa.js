function submits(){
	var flag = 0;
	if(document.form01.cate_1.value == ""){ 
		flag = 1;
	}
	else if(document.form01.cate_2.value == ""){
		flag = 1;
	}	
	else if(document.form01.files.value == ""){
		flag = 1;
	}	
	else if(document.form01.title.value == ""){
		flag = 1;
	}	
	else if(document.form01.main_text.value == ""){
		flag = 1;
	}	
	else if(document.form01.cate_3.value == ""){
		flag = 1;
	}
	if(flag){
		window.alert('必須項目に未入力がありました'); // 入力漏れがあれば警告ダイアログを表示
		return false; // 送信を中止
	}else{
		if(window.confirm('アップロードします。\nよろしいですか？')){
			var target = document.getElementById("form01");
			target.method = "post";
			target.submit();
		}
	}
}
//アップロードファイル名処理
$(function() {
     $('#files').css({
         'position': 'absolute',
         'top': '-9999px'
     }).change(function() {
         var val = $(this).val();
         var path = val.replace(/\\/g, '/');
         var match = path.lastIndexOf('/');
    $('#filename').css("display","inline-block");
         $('#filename').val(match !== -1 ? val.substring(match + 1) : val);
     });
     $('#filename').bind('keyup, keydown, keypress', function() {
         return false;
     });
     $('#filename, #btn').click(function() {
         $('#files').trigger('click');
     });
 });

//プレビュー処理
$(document).ready(function () {
  var view_box = $('.view_box');
   
  $(".file").on('change', function(){
     var fileprop = $(this).prop('files')[0],
         find_img = $(this).next('img'),
         fileRdr = new FileReader();
     
     if(find_img.length){
        find_img.nextAll().remove();
        find_img.remove();
     }
     
    var img = '<div class="layer"></div><img alt="" class="img_view">'; //<a href="#" class="img_del">削除</a>
    view_box.append(img);
     
    fileRdr.onload = function() {    
      view_box.find('img').attr('src', fileRdr.result);
      img_del(view_box); 
    }
    fileRdr.readAsDataURL(fileprop);  
  });
   
  function img_del(target)
  {
     target.find("a.img_del").on('click',function(){
 
      if(window.confirm('サーバーから画像を削除します。\nよろしいですか？'))
      {
         $(this).parent().find('input[type=file]').val('');
         $(this).parent().find('.img_view,.layer, br').remove();
         $(this).remove();
      }
 
      return false;
    });
  }  
});
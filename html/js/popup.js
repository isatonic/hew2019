//Messeage List
$(function () {
  $('#openModal').click
  (function(){
      $('#modalArea').fadeIn(); 
  });	
  $('#closeModal , #modalBg').click
  (function(){
    $('#modalArea').fadeOut();
  });
});

	//内容周回
	$(function(){
		var repeatHtml = document.getElementsByClassName("modalWrapper2");
		var changeHtml="";
		for (var i=1 ; i<=20 ; i++){
			changeHtml += repeatHtml[0].innerHTML;
		}
		repeatHtml[0].innerHTML = changeHtml;
	});




//Friend List
$(function () {
  $('#openModal_Friend_List').click
  (function(){
      $('#modalArea_Friend_List').fadeIn();
  });
  $('#closeModal_Friend_List , #modalBg_Friend_List').click
  (function(){
    $('#modalArea_Friend_List').fadeOut();
  });	
});

	//内容周回
		$(function(){
			var repeatHtml = document.getElementsByClassName("tab_panel");
			var changeHtml="";
			for (var i=1 ; i<=20 ; i++){
				changeHtml += repeatHtml[0].innerHTML;
			}
			repeatHtml[0].innerHTML = changeHtml;
		});
		$(function(){
			var repeatHtml = document.getElementsByClassName("tab_panel2");
			var changeHtml="";
			for (var i=1 ; i<=20 ; i++){
				changeHtml += repeatHtml[0].innerHTML;
			}
			repeatHtml[0].innerHTML = changeHtml;
		});





//Create Messeage
$(function () {
  $('#openModal_Friend_Select').click
  (function(){
      $('#modalArea_Friend_Select').fadeIn();
  });
  $('#closeModal_Friend_Select , #modalBg_Friend_Select').click
  (function(){
    $('#modalArea_Friend_Select').fadeOut();
  });
});

	//内容周回
	$(function(){
		var repeatHtml = document.getElementsByClassName("modalWrapper4");
		var changeHtml="";
		for (var i=1 ; i<=20 ; i++){
			changeHtml += repeatHtml[0].innerHTML;
		}
		repeatHtml[0].innerHTML = changeHtml;
	});




//Friend Search
$(function () {
  $('#openModal_Friend_Search').click
  (function(){
      $('#modalArea_Friend_Search').fadeIn();
  });
  $('#closeModal_Friend_Search , #modalBg_Friend_Search').click
  (function(){
    $('#modalArea_Friend_Search').fadeOut();
  });
});

$(function(){
	var repeatHtml = document.getElementsByClassName("modalWrapper5");
	var changeHtml="";
	for (var i=1 ; i<=20 ; i++){
		changeHtml += repeatHtml[0].innerHTML;
	}
	repeatHtml[0].innerHTML = changeHtml;
});

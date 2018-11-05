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

$(function(){
	var repeatHtml = document.getElementsByClassName("modalWrapper3");
	var changeHtml="";
	for (var i=1 ; i<=20 ; i++){
		changeHtml += repeatHtml[0].innerHTML;
	}
	repeatHtml[0].innerHTML = changeHtml;
});




//Friend Select
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
//Messeage List
$(function () {
  $('#openModal').click(function(){
      $('#modalArea').fadeIn();
  });
  $('#closeModal , #modalBg').click(function(){
    $('#modalArea').fadeOut();
  });
});

//Friend List
$(function () {
  $('#openModal_Friend_List').click(function(){
      $('#modalArea_Friend_List').fadeIn();
  });
  $('#closeModal_Friend_List , #modalBg_Friend_List').click(function(){
    $('#modalArea_Friend_List').fadeOut();
  });
});

//Friend Select
$(function () {
  $('#openModal_Friend_Select').click(function(){
      $('#modalArea_Friend_Select').fadeIn();
  });
  $('#closeModal_Friend_Select , #modalBg_Friend_Select').click(function(){
    $('#modalArea_Friend_Select').fadeOut();
  });
});

//Friend Search
$(function () {
  $('#openModal_Friend_Search').click(function(){
      $('#modalArea_Friend_Search').fadeIn();
  });
  $('#closeModal_Friend_Search , #modalBg_Friend_Search').click(function(){
    $('#modalArea_Friend_Search').fadeOut();
  });
});
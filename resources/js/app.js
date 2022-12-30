$(function () {

  //////////////////////
  // フラッシュメッセージ
  let msgWindow = $('.js-show-flashMsg');

  if ($('.js-get-flashMsg').text()) {
    msgWindow.toggleClass('active');
    setTimeout(function(){
      msgWindow.toggleClass('active');
    }, 4000);
  }


});

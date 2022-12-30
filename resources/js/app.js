$(function () {
  //////////////////////
  // ヘッダーの色変化
  let screenHeight = $('.js-header-change-target').height();
  $(window).on('scroll', function(){
    $('.js-change-header').toggleClass('active', $(this).scrollTop() < screenHeight);
    $('.js-change-header_form').toggleClass('nonactive', $(this).scrollTop() < screenHeight/2);
  });

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

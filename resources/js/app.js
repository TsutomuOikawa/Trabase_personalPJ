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

//////////////////////
  // プロフィールカルーセル
  let whole = $('.js-set-height');
  let movingContainer = $('.js-move-position');
  // カルーセルアイテムの数とcssのmin-widthにセットしたパーセンテージを指定
  let itemNum = 3;
  let setMinWidth = 33;
  // innerWidthでは、「画面に表示された幅*setMinWidth」が取得されるので、倍率を戻す
  let itemWidth = $('.carousel_item:first-child').innerWidth() * 100/setMinWidth ;
  let containerWidth = itemWidth * itemNum;
  // コンテナの幅をセット
  movingContainer.css('width', containerWidth + 'px');

  let switch1 = $('.js-switch-carousel01');
  let switch2 = $('.js-switch-carousel02');
  let switch3 = $('.js-switch-carousel03');
  function changeActive( pushed, stay1, stay2 ) {
    pushed.addClass('active').removeClass('nonactive');
    stay1.addClass('nonactive').removeClass('active');
    stay2.addClass('nonactive').removeClass('active');
  }

  switch1.on('click', function() {
    movingContainer.animate({left: (itemWidth * 0) + 'px'}, 800);
    changeActive( switch1, switch2, switch3 );
  });
  switch2.on('click', function() {
    movingContainer.animate({left: '-' + (itemWidth * 1) + 'px'}, 800);
    changeActive( switch2, switch1, switch3 );
  });
  switch3.on('click', function() {
    movingContainer.animate({left: '-' + (itemWidth * 2) + 'px'}, 800);
    changeActive( switch3, switch1, switch2 );
  });





});

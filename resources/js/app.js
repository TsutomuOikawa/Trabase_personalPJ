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
  let movingContainer = $('.js-move-position');
  // カルーセルアイテムの数とcssのmin-widthにセットしたパーセンテージを指定
  let itemNum = 3;
  let itemWidth = $('.carousel_item:first-child').innerWidth();
  let containerWidth = itemWidth * itemNum;
  // コンテナの幅をセット
  movingContainer.css('width', containerWidth + 'px');

  let s1 = $('.js-switch-carousel01');
  let s2 = $('.js-switch-carousel02');
  let s3 = $('.js-switch-carousel03');
  function changeActive( pushed, stay1, stay2 ) {
    pushed.addClass('active').removeClass('nonactive');
    stay1.addClass('nonactive').removeClass('active');
    stay2.addClass('nonactive').removeClass('active');
  }

  s1.on('click', function() {
    movingContainer.animate({left: (itemWidth * 0) + 'px'}, 800);
    changeActive( s1, s2, s3 );
  });
  s2.on('click', function() {
    movingContainer.animate({left: '-' + (itemWidth * 1) + 'px'}, 800);
    changeActive( s2, s1, s3 );
  });
  s3.on('click', function() {
    movingContainer.animate({left: '-' + (itemWidth * 2) + 'px'}, 800);
    changeActive( s3, s1, s2 );
  });

  //////////////////////
    // モーダル表示
    let modal = $('.js-modal');
    $('.js-show-modal').on('click', function() {
      setTimeout(function() {
        modal.show();
      }, 500);
    });
    // モーダル非表示
    $('.js-hide-modal').on('click', function() {
      modal.hide();
    });






});

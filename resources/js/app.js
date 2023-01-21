$(function () {
//////////////////////
  // スクロールによる変更
  let screenHeight = $('.js-header-change-target').height();
  $(window).on('scroll', function(){
    let $this = $(this);
    // ヘッダー
    $('.js-change-header').toggleClass('js-transparent', $this.scrollTop() < screenHeight/1.4);
    $('.js-change-header_form').toggleClass('js-nonactive', $this.scrollTop() < screenHeight/1.4);
    // ファーストビュー
    $('.js-hide-title').toggleClass('js-nonactive', $this.scrollTop() > screenHeight/4);
  });

//////////////////////
  // ヘッダーハンバーガーメニュー
  $('.js-menu-trigger').on('click', function() {
    $(this).toggleClass('js-active');
    $('.js-slide-menu').toggleClass('js-active');
  })

//////////////////////
  // ヘッダー検索窓
  $('.js-form-trigger').on('click', function() {
    $(this).children().toggleClass('fa-magnifying-glass').toggleClass('fa-chevron-up');
    $('.header_form').toggleClass('js-active');
  })

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
  // プロフィール編集カルーセル
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

//////////////////////
  // マイページタブ
  $('.js-get-tab').on('click', function() {
    let $this = $(this);
    let tabName = $this.text().toLowerCase();
    // 現在の要素を非活性
    $('.js-get-tab'+'.selected').removeClass('selected');
    $('.js-show-contents'+'.active').removeClass('active');
    // 選択した要素を活性
    $this.addClass('selected');
    $('#'+tabName).addClass('active');
  });

//////////////////////
  // ノート執筆時のサムネ用ファイルインプットタグ表示
  $('.js-add-thumbnail').on('click', function() {
    let $this = $(this);
    $this.hide();
    $this.prev('img').hide();
    $this.next().show();
  });

//////////////////////
  // 都道府県パネルのトグル表示
  $('.js-switch-toggle-list').on('click', function() {
    let $this = $(this);
    $this.next('.js-toggle-list').toggleClass('active');
    $this.children().toggleClass('fa-square-plus').toggleClass('fa-square-minus')
  })

//////////////////////
  // 都道府県パネルホバー時の背景変更
  $('.js-change-back').hover(
    function() {
      let src = $(this).children('img').attr('src');
      $('.js-change-back-target').css('background-image', 'url('+ src +')');
    },
    function() {
      $('.js-change-back-target').css('background-image', '');
    }
  )

//////////////////////
  // お気に入り
  $('.js-favorite').on('click', function() {
    let $pushed = $(this);
    let note_id = $pushed.data('note_id');
    let url = '/notes/favorite/' + note_id;
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: url,
      data: {note_id: note_id}
    }).done(function() {
      $pushed.toggleClass('fa-regular fa-solid js-active');
    }).fail(function() {
    })
  });


//////////////////////
  // 特定のページで読み込みたいjsの<script>を生成する関数
  function createScript(fileName) {
    let scriptTag = document.createElement('script');
    scriptTag.src = fileName;
    scriptTag.async = true;
    $('body').append(scriptTag);
  }


//////////////////////
  // googleMap　の表示
  // let prefRegexp = new RegExp('/pref/[1-9]+[0-9]*');
  // if (prefRegexp.test(location.pathname)) {
    // // GoogleMap用のスクリプトをヘッダーに追加
    // let script = document.createElement('script');
    // script.src = 'https://maps.googleapis.com/maps/api/js?language=ja&key=';
    // // AIzaSyBieNmkYCkzbD65SGnFd_UyhUrFqCYkmcU
    // script.async = true;
    // document.head.appendChild(script);
    // console.log(script);

    // google-map.jsを読み込み
    // createScript('http://0.0.0.0:5173/resources/js/google-map.js');
  // }






});

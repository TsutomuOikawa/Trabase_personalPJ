import {makeSlider} from './slider.js';
import {setEditor} from './editor.js';

$(function () {
//////////////////////
  // スライダー
  makeSlider();
  // エディター
  setEditor();

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
    msgWindow.toggleClass('js-active');
    setTimeout(function(){
      msgWindow.toggleClass('js-active');
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
    pushed.addClass('js-active').removeClass('js-nonactive');
    stay1.addClass('js-nonactive').removeClass('js-active');
    stay2.addClass('js-nonactive').removeClass('js-active');
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
  let $modal = $('.js-modal');
  $('.js-show-modal').on('click', function() {
    setTimeout(function() {
      $modal.show();
    }, 500);
  });
  // モーダル非表示
  $('.js-hide-modal').on('click', function() {
    $modal.hide()
  });

//////////////////////
  // マイページタブ
  $('.js-get-tab').on('click', function() {
    let $this = $(this);
    let tabName = $this.text().toLowerCase();
    // 現在の要素を非活性
    $('.js-get-tab'+'.selected').removeClass('selected');
    $('.js-show-contents'+'.js-active').removeClass('js-active');
    // 選択した要素を活性
    $this.addClass('selected');
    $('#'+tabName).addClass('js-active');
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
    $this.next('.js-toggle-list').toggleClass('js-active');
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
  // ノート一覧ページのソート、表示件数選択
  let selectTag = $('.js-change-num');
  let params = new URLSearchParams(location.search);
  // 表示件数が変わったらajax
  selectTag.on('change', function() {
    let num = selectTag.children(':selected').val();
    params.delete('page');
    params.set('num', num);
    window.location = '/notes?' + params.toString();
  });

  // 選択中のソートにデコレーションをつける
  let currentSort = params.get('sort');
  if (currentSort === 'bookmarks') {
    $('.js-set-link:eq(1)').css('text-decoration', 'underline');
  }
  else if (currentSort === 'comments') {
    $('.js-set-link:eq(2)').css('text-decoration', 'underline');
  }
  else {
    $('.js-set-link:eq(0)').css('text-decoration', 'underline');
  }

  // ソートのaタグに表示件数のパラメータをセット
  let num = selectTag.children(':selected').val();
  $('.js-set-link').each(function() {
    let $this = $(this);
    let href = $this.attr('href');
    $this.attr('href', href + '&num=' + num);
  });

});

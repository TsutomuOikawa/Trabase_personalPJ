import {setEditor} from './editor.js';

$(function () {
//////////////////////
  // スライダー
  // エディター
  setEditor();
  // ウィンドウ
  let $window = $(window);

//////////////////////
  // プロフィール編集カルーセル
  let movingContainer = $('.js-move-position');
  // カルーセルアイテムの数とcssのmin-widthにセットしたパーセンテージを指定
  let itemNum = 3;
  let itemWidth = $('.carousel_item:first-child').innerWidth();
  let containerWidth = itemWidth * itemNum;
  // コンテナの幅をセット
  movingContainer.css('width', containerWidth + 'px');

  $('.js-switch-carousel').on('click', function() {
    let $this = $(this), num = $this.index();
    movingContainer.animate({left: '-' + (itemWidth * num) + 'px'}, 800);
    $('.js-switch-carousel' + '.js-active').removeClass('js-active');
    $this.addClass('js-active');
  });

//////////////////////
  // モーダル表示
  let $modal = $('.js-modal');
  let $body = $('body');
  $('.js-show-modal').on('click', function() {
    setTimeout(function() {
      $modal.show();
      $body.css('overflow-y', 'hidden');
    }, 500);
  });

  // ウィッシュリストからモーダルをオープンした時は内容をコピーしてフォームにセット
  $('.js-get-wish').on('click', function() {
    let $wish = $(this).prev('table');
    let spot = $wish.find('.js-get-spot').text();
    let thing = $wish.find('.js-get-thing').text();
    $modal.find('[name=spot]').attr('value', spot);
    $modal.find('[name=thing]').attr('value', thing);
  })

  // モーダル非表示
  $('.js-hide-modal').on('click', function() {
    $body.css('overflow-y', 'auto');
    $modal.hide()
    // フォームの内容を削除
    $modal.find('input').each(function () {
      $(this).attr('value', '');
    })
  });

//////////////////////
  // マイページタブ
  $('.js-get-tab').on('click', function() {
    let $this = $(this);
    let tabNum = $this.index();
    // 現在の要素を非活性
    $('.js-get-tab'+'.js-selected').removeClass('js-selected');
    $('.js-show-contents'+'.js-active').removeClass('js-active');
    // 選択した要素を活性
    $this.addClass('js-selected');
    $('.js-show-contents').eq(tabNum).addClass('js-active');
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
    })

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

    }).done(function( result ) {
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

$(function() {

  // 画面幅によってマップサイズを変更
  let mapWidth,
  windowWidth = $(window).width(), windowSP = 420, windowPC = 960;
  if (windowWidth <= windowSP) {
    mapWidth = 350;
  } else if(windowWidth >= windowPC){
    mapWidth = 650;
  } else {
    mapWidth = 500;
  }

  // ページによって処理を変更
  let currentPath = location.pathname;
  // トップページ
  if (currentPath === '/') {
    $('.js-japanMap').japanMap({
      width: mapWidth,
      selection: 'prefecture',
      drawsBoxLine : false,
      movesIslands : true,
      onHover: function(data) {
        $('.js-insert-pref').text(data.name);
      },
      onSelect: function(data) {
        window.location = 'prefectures/' + data.code;
      }
    });

    // マイページ
  }else if (currentPath.includes('/mypage')) {

    let prefs = [...Array(47)].map((_, i) => i+1);
    let areas = [
      {code: 0, name: '未旅行', prefectures: [], color: '#808080', hoverColor: '#7ba23f'},
      {code: 1, name: '旅行済み', prefectures: [], color: '#2d6d4b', hoverColor: '#7ba23f'},
    ];
    let visited = [], progress;

    // マイページのノートから旅行済みの県を取得
    $('.js-get-visited').children().each( function () {
      visited = Number( $(this).data('prefecture') );
      areas[1].prefectures.push(visited);
    });
    // 未旅行の県を取得
    areas[0].prefectures = prefs.filter(i=>areas[1].prefectures.indexOf(i) == -1);
    // 踏破の進捗状況を表示
    $('.js-insert-progress').text( areas[0].prefectures.length );

    $('.js-japanMap').japanMap({
      width: mapWidth,
      selection: 'prefecture',
      areas: areas,
      drawsBoxLine : false,
      movesIslands : true,
      onSelect: function(data){
        switch (data.area.code) {
          case 0:
            window.location = '/prefectures/' + data.code;
            break;

          case 1:
            let modal = $('.js-modal');
            let html = '<ul class="modal_list">', links = [];
            $('.mypage_contents:eq(1)').find('[data-prefecture=' + data.code + ']').each( function () {
              let $this = $(this);
              links.push('<li class="modal_action"><a href="'+ $this.children('a').attr('href') +'">'+ $this.find('.panel_title').text() +'</a></li>');
            });
            links.forEach(function(elm){ html += elm; });

            $('.js-insert-content').html(html + '</ul>');
            modal.show();
        }
      }
    });
  }
})

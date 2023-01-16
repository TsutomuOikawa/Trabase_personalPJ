$(function(){
  // ページによって処理を変更
  let currentPath = location.pathname;

  // トップページ
  if (currentPath === '/') {
    $('.js-japanMap').japanMap({
      width: 650,
      selection: 'prefecture',
      drawsBoxLine : false,
      movesIslands : true,
      onSelect: function(data){
          window.location = 'pref/' + data.code;
      }
    });

    // マイページ
  }else if (currentPath.includes('/mypage')) {

    let prefs = [...Array(47)].map((_, i) => i+1);
    let areas = [
      {code: 0, name: '未旅行', prefectures: [], color: '#808080', hoverColor: '#7ba23f'},
      {code: 1, name: '旅行済み', prefectures: [], color: '#2d6d4b', hoverColor: '#7ba23f'},
    ];
    let visited = [];

    // マイページのノートから旅行済みの県を取得
    $('.js-get-visited').each( function () {
      visited = Number( $(this).text() );
      areas[1].prefectures.push(visited);
    });
    // 未旅行の県を取得
    areas[0].prefectures = prefs.filter(i=>areas[1].prefectures.indexOf(i) == -1);

    $('.js-japanMap').japanMap({
      width: 650,
      selection: 'prefecture',
      areas: areas,
      drawsBoxLine : false,
      movesIslands : true,
      onSelect: function(data){
        switch (data.area.code) {
          case 0:
            window.location = '/pref/' + data.code;
            break;

          case 1:
            let modal = $('.js-modal');
            let links = [];
            let html = '';
            $('.js-get-links:contains(' + data.name+ ')').each( function () {
              links.push('<li class="modal_action"><a href="'+ $(this).attr('href') +'">'+ $(this).find('.panel_title').html() +'</a></li>');
            });
            links.forEach(function(elm){ html += elm; });

            $('.js-insert-content').html('<ul class="modal_list">'+ html +'</ul>');
            modal.show();
        }
      }
    });

  }
// 最終閉じ
});

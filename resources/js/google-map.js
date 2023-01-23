
// マップ初期化関数
function initMap() {

  let elm = document.getElementById('googleMap'); //マップを表示する要素を指定
  let address = document.querySelector('h1').textContent; //都道府県を指定
  let geocoder = new google.maps.Geocoder();
  let map;

  geocoder.geocode({ address: address }, function(results, status){
    if (status === 'OK' && results[0]){

      switch (address) {
        case '北海道':
          map = new google.maps.Map(elm, {
            center: results[0].geometry.location,
            zoom: 7
          });
          break;
        default:
          map = new google.maps.Map(elm, {
            center: results[0].geometry.location,
            zoom: 9
          });
          break;
      }
    }
  });

}

window.initMap = initMap;

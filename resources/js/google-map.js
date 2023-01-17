
// マップ初期化関数
function initMap() {

  let elm = document.getElementById('googleMap'); //マップを表示する要素を指定
  let address = document.querySelector('h1').textContent; //都道府県を指定
  let geocoder = new google.maps.Geocoder();

  geocoder.geocode({ address: address }, function(results, status){
    console.log('geocoder');
    if (status === 'OK' && results[0]){
      console.log(results[0].geometry.location);

      switch (address) {
        case '北海道':
          let map = new google.maps.Map(elm, {
            center: results[0].geometry.location,
            zoom: 6
          });
          break;
        default:
          let map = new google.maps.Map(elm, {
            center: results[0].geometry.location,
            zoom: 8
          });
          break;
      }
    }
  });

}

window.initMap = initMap;

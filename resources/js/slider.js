const regex = new RegExp('^/$|^/mypage/?$|^/pref/[1-9]+[0-9/]*$');
let path = location.pathname;

export function makeSlider() {
  if(regex.test(path)){

    new Splide( '.splide', {
      type: 'loop',
      drag: 'free',
      focus: 'center',
      perPage: 8,
      gap: 10,
      arrows: false,
      pagination: false,
      breakpoints: {
        960: { perPage: 6 },
        420: { perPage: 4 }
      },
      autoScroll: {
        speed: 0.5,
        rewind: true,
        pauseOnHover: false
      }
    }).mount( window.splide.Extensions )

  }
}

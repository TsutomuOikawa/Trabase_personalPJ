import { Splide } from "@splidejs/splide";

export function makeSlider() {
    new Splide('.splide', {
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
import {makeMap} from '../parts/japan-map'
makeMap()
import {makeSlider} from '../parts/slider'
makeSlider()

// スクロールによるヘッダーの変更
const BorderHeight: number|undefined = document.querySelector('#ts-header-change-target')?.getBoundingClientRect().bottom as number|undefined
if (BorderHeight) {
    const changeableHeader: HTMLElement|undefined = document.querySelector('.ts-change-header') as HTMLElement|undefined
    const changeableForm: HTMLFormElement|undefined = changeableHeader?.querySelector('.ts-change-header_form') as HTMLFormElement|undefined
    const firstViewTitle: HTMLHeadingElement|undefined = document.querySelector('.firstView_title') as HTMLHeadingElement|undefined

    window.addEventListener('scroll', () => {
        changeableHeader?.classList.toggle('ts-transparent', BorderHeight > window.scrollY)
        changeableForm?.classList.toggle('ts-nonactive', BorderHeight > window.scrollY)
        firstViewTitle?.classList.toggle('ts-nonactive', BorderHeight / 2 < window.scrollY)
    });
};

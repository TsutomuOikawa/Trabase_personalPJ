// ヘッダーハンバーガーメニュー
const menuTrigger: HTMLDivElement = document.querySelector('#ts-menu-trigger') as HTMLDivElement
const menu: HTMLElement = document.querySelector('#ts-slide-menu') as HTMLElement
menuTrigger.addEventListener('click', function() {
    this.classList.toggle('ts-active')
    menu.classList.toggle('ts-active')
});


// ヘッダー検索アイコン
const formTrigger: HTMLButtonElement = document.querySelector('#ts-form-trigger') as HTMLButtonElement
const form: HTMLFormElement = document.querySelector('.header_form') as HTMLFormElement
formTrigger.addEventListener('click', function() {
    const icon: HTMLElement = this.querySelector('i') as HTMLElement
    icon.classList.toggle('fa-magnifying-glass')
    icon.classList.toggle('fa-chevron-up')
    form.classList.toggle('ts-active')
})

// フラッシュメッセージ
const messageWindow: HTMLDivElement|null = document.querySelector('#ts-show-flashMsg') as HTMLDivElement|null
if (messageWindow?.firstElementChild?.innerHTML) {
    messageWindow.classList.toggle('ts-active')
    setTimeout(() => {
        messageWindow.classList.toggle('ts-active')
    }, 4000);
}


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

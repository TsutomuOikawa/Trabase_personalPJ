const modal: HTMLDivElement = document.querySelector('.ts-modal') as HTMLDivElement

// モーダル非表示
const closeButton: HTMLParagraphElement|null = document.querySelector('.ts-hide-modal')
closeButton?.addEventListener('click', () => {
    document.querySelector('body')!.style.overflowY = 'auto'
    modal.style.display = 'none'
    // フォームの内容を削除
    modal.querySelectorAll('input').forEach((input) => {
        input.value = ''
    })
});
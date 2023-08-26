export function makeMap() {
    // デバイス毎にマップサイズを設定
    let mapWidth: number
    const windowWidth: number = window.innerWidth
    const windowSP: number = 420, windowPC: number = 960
    if (windowWidth <= windowSP) {
        mapWidth = 350
    } else if (windowWidth >= windowPC){
        mapWidth = 650
    } else {
        mapWidth = 500
    }

    // ページに応じて処理を変更
    const currentPath: string = location.pathname    
    if (currentPath.includes('mypage')) {
        // TODO:処理を記載
    } else {        
        $('#ts-japan-map').japanMap({
            width: mapWidth,
            selection: 'prefecture',
            drawsBoxLine : false,
            movesIslands: true,
            onHover: function(data: any) {
                const name: HTMLSpanElement|null = document.getElementById('ts-insert-pref')
                if (name instanceof HTMLSpanElement) {
                    name.innerHTML = data.name
                }
            },
            onSelect: function(data: any) {
                window.location = `prefectures/${data.code}`
            }
        })

    }
}

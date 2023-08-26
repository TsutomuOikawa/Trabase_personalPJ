export function makeMap() {
    interface Area {
        code: number,
        name: string,
        prefectures: number[],
        color: string,
        hoverColor: string,
    }
    interface Item {
        ShortName: string,
        area: Area,
        code: number,
        name: string,
    }

    // デバイス毎にマップサイズを設定
    let mapWidth: number
    const windowWidth: number = window.innerWidth
    const windowSP: number = 420, windowPC: number = 960
    if (windowWidth <= windowSP) {
        mapWidth = 350
    } else if (windowWidth >= windowPC) {
        mapWidth = 650
    } else {
        mapWidth = 500
    }

    // ページに応じて処理を変更
    const currentPath: string = location.pathname
    if (currentPath.includes('mypage')) {
        const areas: Area[] = [
          {code: 0, name: '未旅行', prefectures: [], color: '#808080', hoverColor: '#7ba23f'},
          {code: 1, name: '旅行済み', prefectures: [], color: '#2d6d4b', hoverColor: '#7ba23f'},
        ];

        // ノートから旅行済みの都道府県を取得
        const notes = document.getElementById('ts-get-visited')?.querySelectorAll('li')
        if (notes instanceof NodeList) {
            notes.forEach((note) => {
                areas[1].prefectures.push(Number(note.dataset.prefecture))
            })

            // 未旅行の都道府県をセット
            areas[0].prefectures = [...Array(47)].map((_, i) => i+1).filter(i=>areas[1].prefectures.indexOf(i) == -1)
            // 進捗状況に反映
            document.getElementById('ts-insert-progress')!.innerHTML = String(areas[0].prefectures.length)

            $('#ts-japan-map').japanMap({
                width: mapWidth,
                selection: 'prefecture',
                areas: areas,
                drawsBoxLine : false,
                movesIslands : true,
                onSelect: function(item: Item){
                    switch (item.area.code) {
                        case 0:
                        window.location.href = `/prefectures/${item.code}`
                        break;
            
                        case 1:
                        const modal: HTMLDivElement = document.querySelector('.ts-modal') as HTMLDivElement
                        const insertionTarget: HTMLDivElement = document.querySelector('#ts-insert-anchors') as HTMLDivElement
                        const newUl: HTMLUListElement = document.createElement('ul')
                        newUl.classList.add('modal_list')

                        notes.forEach((note) => {
                            if (Number(note.dataset.prefecture) === item.code) {
                                const newAnchor: HTMLAnchorElement = document.createElement('a')
                                newAnchor.href = note.querySelector<HTMLAnchorElement>('a')?.href as string
                                newAnchor.innerHTML = note.querySelector('.panel_title')?.innerHTML as string

                                const newLi: HTMLLIElement = document.createElement('li')
                                newLi.classList.add('modal_action')
                                newLi.appendChild(newAnchor)
                                newUl.appendChild(newLi)
                            }
                        })
                        insertionTarget.innerHTML = ''
                        insertionTarget.appendChild(newUl)
                        modal.style.display = 'block'
                        document.querySelector('body')!.style.overflowY = 'hidden'
                    }
                },
            });
        }

    } else {
        $('#ts-japan-map').japanMap({
            width: mapWidth,
            selection: 'prefecture',
            drawsBoxLine : false,
            movesIslands: true,
            onHover: function(item: Item) {
                const name: HTMLSpanElement|null = document.getElementById('ts-insert-pref')
                if (name) {
                    name.innerHTML = item.name
                }
            },
            onSelect: function(item: Item) {
                window.location.href = `prefectures/${item.code}`
            }
        })
    }
}

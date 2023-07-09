<main class="page-wrapper">
    <div class="container--baseColor">
        <h1 class="container_title">{{ $code }}</h1>
        <div class="container_body">
            {{ $message }}
        </div>
        <div class="container_body">
            <h2 class="list_title">別の旅先を探してみませんか。</h2>
            <p class="smallfont">ノートの検索には上部の検索フォームをご利用ください。</p>
            @component('components.destinations', 
                ['tag' => 'h3', 'prefectures' => $prefectures])
            @endcomponent
        </div>
    </div>
</main>

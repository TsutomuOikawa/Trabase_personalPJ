@extends('layouts.app')
@section('title', '旅の計画と記録に')
@section('headerScript')
  <!-- splide -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
@endsection

@section('content')
<main>
  <section class="hero" style="background-image: url( {{Storage::disk('s3')->url('assets/hero/trabase_top.jpg')}} );">
    <div class="js-header-change-target">
      <section id="firstView" class="firstView">
        <h1 class="firstView_title js-hide-title">旅の情報を<br>集めよう</h1>
        <form class="firstView_form" action="{{ route('notes.index') }}" method="get">
          <input type="text" name="pref" class="header_input" value="{{ old('pref') }}" placeholder="都道府県名を入力">
          <input type="text" name="key" class="header_input" value="{{ old('key') }}" placeholder="キーワードを入力">
          <button type="submit" class="header_submit" name=""><i class="fas fa-search fa-lg"></i></button>
        </form>
      </section>
      <section id="map" class="map container--transparent">
        <h2 class="container_title">日本地図から探す</h2>
        <div class="container_body">
          <p class="map_pref">次の旅先：<span class="js-insert-pref"></span></p>
          <div class="map_japanMap js-japanMap"></div>
        </div>
      </section>
    </div>
      @component('components.slider',
        ['prefectures' => $prefectures])
      @endcomponent
  </section>
  <section id="search" class="search container--baseColor">
    <h2 class="container_title">ノートから探す</h2>
    <div class="container_body">
      <div class="list--note">
        <ul class="list_body--note">
          @component('components.notes',
            ['notes' => $notes])
          @endcomponent
        </ul>
      </div>
    </div>
  </section>
  <section id="about" class="about container--subColor">
    <h2 class="container_title">Trabaseとは</h2>
    <div class="container_body">
      <div class="features-wrapper">
        <div class="feature feature--reverse">
          <img src="{{ Storage::disk('s3')->url('assets/topPage_japanMap.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">日本地図を完成させよう</p>
            <p class="feature_text">記録を残した土地はマイページで確認<br>まだ見ぬ土地を巡りましょう</p>
          </div>
        </div>
        <div class="feature">
          <img src="{{ Storage::disk('s3')->url('assets/topPage_wishLists.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">マイリストで未来の旅を管理</p>
            <p class="feature_text">絶景やグルメ、アクティビティ<br>はたまた静寂に包まれる瞬間など、<br>旅に求めるものは人それぞれ。</p>
            <p class="feature_text">他の旅人の記録やリストも参考に<br>自分だけのリストで管理しましょう</p>
          </div>
        </div>
        <div class="feature feature--reverse">
          <img src="{{ Storage::disk('s3')->url('assets/topPage_editor.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">シンプルなエディタで<br>思い出を記録</p>
            <p class="feature_text">旅行に行ったことは覚えているのに、<br>詳しいことは思い出せない、、<br>そんな経験はありませんか？
            <p class="feature_text">簡単かつシンプルなエディタを使って<br>新鮮な記憶を書き残しましょう</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- 採用担当者様向け -->
  <div class="modal js-message-to-recruiter">
    <div class="modal_content" style="width: 80%;">
      <p class="modal_header">採用ご担当者様</p>
      <div class="dearRecruiters" style="
        background: rgba(217, 217, 217, .4);
        border-radius: 4px;
        color: white;
        padding: 20px;
      ">
        <p>
          この度はTrabaseをご覧くださり、誠にありがとうございます。<br><br>
          本サービスには各都道府県ごとのページ（~~~.com/pref/）がございますが、<br>
          現状、全都道府県にコンテンツが入っているわけではございません。<br>
          データのあるページは、下記をご参照ください。
        </p>
        <p style="margin:30px 0 20px; color: #cfb10e;"><a href="{{ route('pref', ['pref_id'=>2]) }}">青森（https://trabase-heroku.herokuapp.com/pref/2）</a></p>
        <p>※都道府県別のページ以外は問題なくアクセスいただけます。</p>
        <p>※サンプルアカウントのログイン情報は職務経歴書に記載がございます。</p>
        <p style="padding-top:10px;">何卒よろしくお願いいたします。</p>
      </div>
      <p class="modal_action js-hide-message">閉じる</p>
    </div>
    <div class="modal_cover"></div>
  </div>

</main>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
  @vite(['resources/js/jquery.japan-map.min.js', 'resources/js/japan-map.js'])
@endsection

@extends('layouts.app')
@section('title', '旅の計画と記録に')
@section('headerScript')
  <!-- splide -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
@endsection
@section('content')

<main>
  <section class="hero">
    <div class="js-header-change-target">
      <section id="firstView" class="firstView">
        <h1 class="firstView_title js-hide-title">旅の情報を<br>集めよう</h1>
        <form class="firstView_form" action="{{ route('notes.list') }}" method="get">
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
    <div class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          @foreach($notes as $note)
          <li class="splide__slide"><img src="{{ asset($note->thumbnail) }}" class="splide_img" alt=""></li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>

  <section id="search" class="search container--baseColor">
    <h2 class="container_title">ノートから探す</h2>
    <div class="container_body">
      <div class="list--note">
        <ul class="list_body--note">
          @foreach($notes as $note)
          <li class="panel--note">
            <a href="{{ route('notes.article', ['note_id' => $note->note_id]) }}" class="js-get-links">
              <img src="{{ asset('img/IMG_5131.jpg') }}" class="panel_thumbnail" alt="">
              <div class="panel_info">
                <h3 class="panel_title">{{ $note->title }}</h3>
                <div class="userInfo">
                  @if($note->avatar)
                    <img src="{{ asset($note->avatar)}}" class="userInfo_img" alt="{{ $note->name.'さんのプロフィール画像' }}">
                  @else
                    <i class="fa-solid fa-user fa-lg" style="padding-right:10px;"></i>
                  @endif
                  <p class="userInfo_name">{{ $note->name }}</p>
                </div>
                <div class="panel_subInfo">
                  <p>{{ date('y/m/d', strtotime($note->created_at)) }}投稿</p>
                  <div class="iconBox">
                    <i class="fa-bookmark fa-lg @if($note->isFavorite) fa-solid js-active @else fa-regular @endif js-favorite"></i>
                    <span class="iconBox_num">{{ $note->favNum }}</span>
                    <i class="fa-regular fa-comment-dots fa-lg icon--comment"></i>
                    <span class="iconBox_num">{{ $note->comNum }}</span>
                  </div>
                </div>
              </div>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>

  <section id="about" class="about container--subColor">
    <h2 class="container_title">Trabaseとは</h2>
    <div class="container_body">
      <div class="features-wrapper">
        <div class="feature">
          <img src="{{ asset('img/noimage.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">タイトル</p>
            <p class="feature_text">テキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキスト</p>
          </div>
        </div>

        <div class="feature feature--reverse">
          <img src="{{ asset('img/noimage.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">タイトル</p>
            <p class="feature_text">テキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキスト</p>
          </div>
        </div>

        <div class="feature">
          <img src="{{ asset('img/noimage.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">タイトル</p>
            <p class="feature_text">テキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキスト</p>
          </div>
        </div>

        <div class="feature feature--reverse">
          <img src="{{ asset('img/noimage.png') }}" class="feature_img" alt="">
          <div class="feature_description">
            <p class="feature_title">タイトル</p>
            <p class="feature_text">テキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキスト</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection
@section('script')
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
  @vite(['resources/js/jquery.japan-map.min.js', 'resources/js/japan-map.js', 'resources/js/app.js'])
@endsection

@extends('layouts.app')
@section('title', '旅の計画と記録に')
@section('content')

<main>
  <section class="hero js-header-change-target">
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
      <div class="imgSlider">
        <ul class="imgSlider_list">
          @for($i=1; $i<=10; $i++)
          <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
          @endfor
        </ul>
      </div>
    </section>
  </section>

  <section id="search" class="search container--baseColor">
    <h2 class="container_title">ノートから探す</h2>
    <div class="container_body">
      <div class="list--note">
        <ul class="list_body--note">
          @foreach($notes as $note)
          <li class="panel--note">
            <a href="{{ route('notes.article', ['note_id' => $note->note_id]) }}">
              <img src="img/IMG_5131.JPG" class="panel_thumbnail" alt="">
              <div class="panel_info">
                <h3 class="panel_title">{{ $note->title }}</h3>
                <div class="userInfo">
                  @if($note->user->avatar)
                    <img src="{{ asset($note->user->avatar)}}" class="userInfo_img" alt="{{ $note->name.'さんのプロフィール画像' }}">
                  @else
                    <i class="fa-solid fa-user fa-lg" style="padding-right:10px;"></i>
                  @endif
                  <p class="userInfo_name">{{ $note->user->name }}</p>
                </div>
                <p class="panel_subInfo">{{ date('y年m月d日', strtotime($note->created_at)) }}投稿</p>
                <div class="iconBox">
                  <i class="fa-regular fa-bookmark icon--bookmark"></i>
                  <span class="iconBox_num">33</span>
                  <i class="fa-regular fa-comment-dots icon--comment"></i>
                  <span class="iconBox_num">2</span>
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
@vite(['resources/js/jquery-3.6.0.min.js', 'resources/js/jquery.japan-map.min.js', 'resources/js/japan-map.js'])

@endsection

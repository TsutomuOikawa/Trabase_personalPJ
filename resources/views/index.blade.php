@extends('layouts.app')
@section('content')

<main>
  <section id="firstView" class="firstView js-header-change-target">
    <div class="firstView_container">
      <h1 class="firstView_title">旅の思い出<span>、</span><br>のぞき見しよう</h1>
      <form class="header_form" action="{{ route('notes.list') }}" method="get">
        <input type="text" name="pref" class="header_input" value="{{ old('pref') }}" placeholder="都道府県名を入力">
        <input type="text" name="key" class="header_input" value="{{ old('key') }}" placeholder="キーワードを入力">
        <button type="submit" class="header_submit" name=""><i class="fas fa-search fa-lg"></i></button>
      </form>
    </div>
  </section>

  <section id="map" class="container map">
    <h2 class="container_title">次の目的地は？</h2>
    <div class="container_body">
      <div class="map">

      </div>
    </div>
  </section>
  <div class="imgSlider">
    <ul class="imgSlider_list">
      @for($i=1; $i<=10; $i++)
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      @endfor
    </ul>

  </div>
  <section id="about" class="container--subColor">
    <h2 class="container_title">Globe Noteとは</h2>
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
  <section id="search" class="container--baseColor">
    <h2 class="container_title">旅先を探す</h2>
    <div class="container_body">
      <h3 class="list_title">人気のノートから探す</h3>
      <div class="list--note">
        <ul class="list_body--note">

          @foreach($notes as $note)
          <li class="panel--note">
            <img src="img/IMG_5131.JPG" class="panel_thumbnail" alt="">
            <div class="panel_info">
              <h3 class="panel_title">{{ $note->title }}</h3>
              <div class="userInfo">
                <img src="img/プロフィールアイコン：有色.jpeg" class="userInfo_img" alt="">
                <p class="userInfo_name">{{ $note->user->name }}</p>
              </div>
              <p class="panel_postDay">{{ date('y/m/d', strtotime($note->created_at)) }} 投稿</p>
              <div class="iconBox">
                <i></i>
                <span></span>
                <i></i>
                <span></span>
              </div>
            </div>
          </li>
          @endforeach

        </ul>
      </div>
      <h3 class="list_title">都道府県一覧から探す</h3>
      <div class="list--destination">
        <h4 class="list_title--destination">北海道・東北</h3>
        <div class="list_body--destination">
          @foreach($prefs as $pref)
          <a href="{{ route('pref', ['pref_id' => $pref->pref_id]) }}" class="panel--destination">
            <img src="{{ asset('img/IMG_3930.JPG') }}" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">{{ $pref->pref_name }}</span>
          </a>

          @switch($pref->pref_id)
          @case(7)
        </div>
        <h4 class="list_title">関東</h3>
        <div class="list_body--destination">
          @break
          @case(14)
        </div>
        <h4 class="list_title">中部</h3>
        <div class="list_body--destination">
          @break
          @case(23)
        </div>
        <h4 class="list_title">近畿</h3>
        <div class="list_body--destination">
          @break
          @case(30)
        </div>
        <h4 class="list_title">中国</h3>
        <div class="list_body--destination">
          @break
          @case(35)
        </div>
        <h4 class="list_title">四国</h3>
        <div class="list_body--destination">
          @break
          @case(39)
        </div>
        <h4 class="list_title">九州・沖縄</h3>
        <div class="list_body--destination">

          @default
          @endswitch
          @endforeach
        </div>
      </div>
    </div>
  </section>
</main>

@endsection

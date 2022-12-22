@extends('layouts.app')
@section('content')

<main>
  <section id="firstView" class="firstView js-header-change-target">
    <div class="firstView_container">
      <h1 class="firstView_title">旅の思い出<span>、</span><br>のぞき見しよう</h1>
      <form class="header_form" action="index.html" method="post">
        <input type="text" name="" class="header_input" value="" placeholder="都道府県名を入力">
        <input type="text" name="" class="header_input" value="" placeholder="キーワードを入力">
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
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
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
          <li class="panel--note">
            <img src="img/IMG_5131.JPG" class="panel_thumbnail" alt="">
            <div class="panel_info">
              <h3 class="panel_title">朝5時に家を出てから、18時間での熊本訪問</h3>
              <div class="userInfo">
                <img src="img/プロフィールアイコン：有色.jpeg" class="userInfo_img" alt="">
                <p class="userInfo_name">ユーザーネーム</p>
              </div>
              <p class="panel_postDay">2002/08/06投稿</p>
              <div class="iconBox">
                <i></i>
                <span></span>
                <i></i>
                <span></span>
              </div>
            </div>
          </li>

          <li class="panel--note">
            <img src="img/6241759280_IMG_3459.JPG" class="panel_thumbnail" alt="">
            <div class="panel_info">
              <h3 class="panel_title">熊本の、城とラーメンと人情と</h3>
              <div class="userInfo">
                <img src="{{ asset('img/noimage.png') }}" class="userInfo_img" alt="">
                <p class="userInfo_name">ユーザーネーム</p>
              </div>
              <p class="panel_postDay">2002/08/06投稿</p>
              <div class="iconBox">
                <i></i>
                <span></span>
                <i></i>
                <span></span>
              </div>
            </div>
          </li>

          <li class="panel--note">
            <img src="img/6176658528_IMG_4498.JPG" class="panel_thumbnail" alt="">
            <div class="panel_info">
              <h3 class="panel_title">いつか行ってみたいと思っていた熊本に行ってきました！</h3>
              <div class="userInfo">
                <img src="img/プロフィール.JPG" class="userInfo_img" alt="">
                <p class="userInfo_name">ユーザーネーム</p>
              </div>
              <p class="panel_postDay">2002/08/06投稿</p>
              <div class="iconBox">
                <i></i>
                <span></span>
                <i></i>
                <span></span>
              </div>
            </div>
          </li>

          <li class="panel--note">
            <img src="img/IMG_5506.JPG" class="panel_thumbnail" alt="">
            <div class="panel_info">
              <h3 class="panel_title">タイトル</h3>
              <div class="userInfo">
                <img src="{{ asset('img/noimage.png') }}" class="userInfo_img" alt="">
                <p class="userInfo_name">ユーザーネーム</p>
              </div>
              <p class="panel_postDay">2002/08/06投稿</p>
              <div class="iconBox">
                <i></i>
                <span></span>
                <i></i>
                <span></span>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <h3 class="list_title">都道府県一覧から探す</h3>
      <div class="list--destination">
        <h4 class="list_title--destination">北海道・東北</h3>
        <div class="list_body--destination">
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">北海道</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">青森</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">岩手</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">宮城</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">秋田</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">山形</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">福島</span>
          </a>
        </div>

        <h4 class="list_title--destination">南関東</h3>
        <div class="list_body--destination">
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">東京</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">神奈川</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">埼玉</span>
          </a>
          <a class="panel--destination">
            <img src="img/IMG_3930.JPG" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">千葉</span>
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection

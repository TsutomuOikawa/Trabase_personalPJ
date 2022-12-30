@extends('layouts.app')
@section('title', 'マイページ｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container">
    <h1 class="container_title">マイページ</h1>
    <div class="container_body--l container_body--2col">
      <div class="mypage">
        <nav class="mypage_nav">
          <p>Map</p>
          <span class="itemSeparater"></span>
          <p>Notes</p>
          <span class="itemSeparater"></span>
          <p>WishLists</p>
          <span class="itemSeparater"></span>
          <p>Favorites</p>
        </nav>
        <div class="mypage_article">

          <section id="map" class="mypage_contents map">
            <h2 class="mypage_title">MY MAP</h2>
            <div class="mypage_body">
              <div class="map">

              </div>
            </div>
          </section>

          <section id="note" class="mypage_contents">
            <h2 class="mypage_title">記録済みノート</h2>
            <div class="mypage_body">
              <div class="list--note">
                <ul class="list_body--note">
                  @foreach ($myNotes as $myNote)
                  <li class="panel--note">
                    <img src="{{ asset('img/IMG_5131.jpg') }}" class="panel_thumbnail" alt="">
                    <div class="panel_info">
                      <h3 class="panel_title">{{ $myNote->title }}</h3>
                      <div class="userInfo">
                        <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img" alt="">
                        <p class="userInfo_name">{{ $user->name }}</p>
                      </div>
                      <p class="panel_postDay">{{ date('y/m/d', strtotime($myNote->created_at)) }} 投稿</p>
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
            </div>
          </section>

          <section id="favorites" class="mypage_contents">
            <h2 class="mypage_title">お気に入りのノート</h2>
            <div class="mypage_body">
              <div class="list--note">
                <ul class="list_body--note">
                  <li class="panel--note">
                    <img src="{{ asset('img/IMG_5131.jpg') }}" class="panel_thumbnail" alt="">
                    <div class="panel_info">
                      <h3 class="panel_title">朝5時に家を出てから、18時間での熊本訪問</h3>
                      <div class="userInfo">
                        <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img" alt="">
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
                    <img src="{{ asset('img/6241759280_IMG_3459.jpg') }}" class="panel_thumbnail" alt="">
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
                    <img src="{{ asset('img/6176658528_IMG_4498.jpg') }}" class="panel_thumbnail" alt="">
                    <div class="panel_info">
                      <h3 class="panel_title">いつか行ってみたいと思っていた熊本に行ってきました！</h3>
                      <div class="userInfo">
                        <img src="{{ asset('img/プロフィール.jpg') }}" class="userInfo_img" alt="">
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
                    <img src="{{ asset('img/IMG_5506.jpg') }}" class="panel_thumbnail" alt="">
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
            </div>
          </section>

          <section id="" class="mypage_contents">
            <h2 class="mypage_title">MyLists</h2>
            <div class="mypage_body">
              <div class="list--wish">
                <ul class="list_body--wish">
                  @for($i=1; $i<=10; $i++)
                  <li class="panel--wish">
                    <div class="userInfo">
                      <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img" alt="">
                      <p class="userInfo_name">ユーザーネーム</p>
                    </div>
                    <table class="panel_table">
                      <tr class="panel_tableElm">
                        <th>WHERE</th>
                        <td>熊本城</td>
                      </tr>
                      <tr class="panel_tableElm">
                        <th>WHAT</th>
                        <td>雪の熊本城を撮りたい！</td>
                      </tr>
                    </table>
                  </li>
                  @endfor
                </ul>
              </div>
            </div>
          </section>

        </div>
      </div>

      <div class="sidebar">
        <div class="sidebar_contents">
          <div class="sidebar_profile">
            <div class="userInfo userInfo--big">
              <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img userInfo_img--big" alt="">
              <p class="userInfo_name userInfo_name--big">{{ $user->name }}</p>
            </div>

          </div>
          <ul class="sidebar_menu">
            <li>password</li>
            <li>logout</li>
            <li>withdrawal</li>
          </ul>
        </div>
      </div>

    </div>
    <div class="imgSlider">
      <ul class="imgSlider_list">
        @for($i=1; $i<=10; $i++)
        <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
        @endfor
      </ul>
    </div>
  </div>
</main>

@endsection

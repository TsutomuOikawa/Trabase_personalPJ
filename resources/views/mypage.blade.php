@extends('layouts.app')
@section('title', 'マイページ｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container">
    <div class="container_head">
      <h1 class="container_title">マイページ</h1>
    </div>
    <div class="container_body--l container_body--2col">
      <div class="mypage">
        <ul class="mypage_nav">
          <li class="mypage_navItem js-get-tab">Map</li>
          <li class="mypage_navItem js-get-tab selected">Notes</li>
          <li class="mypage_navItem js-get-tab">WishList</li>
          <li class="mypage_navItem js-get-tab">Favorites</li>
        </ul>
        <div class="mypage_article">

          <section id="map" class="mypage_contents map js-show-contents">
            <h2 class="mypage_title">MY MAP</h2>
            <div class="map">

            </div>
          </section>

          <section id="notes" class="mypage_contents js-show-contents active">
            <h2 class="mypage_title">記録済みノート</h2>
            <div class="list--note">
              <ul class="list_body--note">
                @foreach ($myNotes as $myNote)
                <li class="panel--note">
                  <a href="{{ route('notes.article', ['note_id' => $myNote->note_id]) }}">
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
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
          </section>

          <section id="wishlist" class="mypage_contents js-show-contents">
            <h2 class="mypage_title">Wish Lists</h2>
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
          </section>

          <section id="favorites" class="mypage_contents js-show-contents">
            <h2 class="mypage_title">お気に入りのノート</h2>
            <div class="list--note">
              <ul class="list_body--note">
                <li class="panel--note">
                  <a href="#">
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
                  </a>
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
          </section>

        </div>
      </div>

      <div class="sidebar">
        <div class="sidebar_contents">
          <div class="sidebar_profile">
            <div class="userInfo userInfo--big">
              <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img userInfo_img--big" alt="">
              <p class="userInfo_name userInfo_name--big">{{ $user->name }}</p>
              <p>{{ $user->intro }}</p>
            </div>

          </div>
          <ul class="sidebar_menu">
            <li><a href="{{ route('profile.edit') }}">プロフィール編集</a></li>
            <li><a href="{{ route('logout') }}">ログアウト</a></li>
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

@extends('layouts.app')
@section('title', 'マイページ｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container">
    <h1 class="container_title container_title--mypage">マイページ</h1>
    <div class="container_body container_body--col">
      <div class="mypage">
        <ul class="mypage_nav">
          <li class="mypage_navItem js-get-tab selected">マップ</li>
          <li class="mypage_navItem js-get-tab">ノート</li>
          <li class="mypage_navItem js-get-tab">イキタイ！</li>
          <li class="mypage_navItem js-get-tab">ブックマーク</li>
        </ul>
        <div class="mypage_article">

          <section id="マップ" class="mypage_contents js-show-contents active">
            <h2 class="mypage_title">マップ</h2>
            <div class="js-japanMap"></div>
            <div class="modal js-modal">
              <div class="modal_content">
                <p class="modal_header">投稿済みのノート</p>
                <div class="js-insert-content"></div>
                <p class="modal_action js-hide-modal">&gt; 閉じる</p>
              </div>
              <div class="modal_cover"></div>
            </div>
          </section>

          <section id="ノート" class="mypage_contents js-show-contents">
            <h2 class="mypage_title">記録済みノート</h2>
            <div class="list--note">
              <ul class="list_body--scrollNote">
                @foreach ($myNotes as $note)
                <li class="panel--note js-get-links">
                  <p class="panel_pref">{{ $note->pref_name }}</p>
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
                  <span  class="js-get-visited" style="display:none;">{{ $note->pref_id }}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </section>

          <section id="イキタイ！" class="mypage_contents js-show-contents">
            <h2 class="mypage_title">イキタイ！リスト</h2>
            <div class="list--wish">
              <ul class="list_body--wish">
                @foreach($wishes as $wish)
                <li class="panel--wish">
                  <div class="userInfo">
                    <img src="{{ asset($wish->user->avatar) }}" class="userInfo_img">
                    <p class="userInfo_name">{{ $wish->user->name }}</p>
                  </div>
                  <table class="panel_table">
                    <tr class="panel_tableElm">
                      <th>WHERE</th>
                      <td>{{ $wish->place }}</td>
                    </tr>
                    <tr class="panel_tableElm">
                      <th>WHAT</th>
                      <td>{{ $wish->thing }}</td>
                    </tr>
                  </table>
                </li>
                @endforeach
              </ul>
            </div>
          </section>

          <section id="ブックマーク" class="mypage_contents js-show-contents">
            <h2 class="mypage_title">ブックマーク済みのノート</h2>
            <div class="list--note">
              <ul class="list_body--scrollNote">
                @foreach ($favNotes as $note)
                <li class="panel--note">
                  <p class="panel_pref">{{ $note->pref_name }}</p>
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
          </section>

        </div>
      </div>

      <div class="sidebar">
        <div class="sidebar_wrapper">
          <div class="sidebar_profile">
            <div class="userInfo userInfo--big">
              <img src="{{ asset($user->avatar) }}" class="userInfo_img userInfo_img--big" alt="">
              <p class="userInfo_name userInfo_name--big">{{ $user->name }}</p>
              <p class="userInfo_intro">{{ $user->intro }}</p>
            </div>
          </div>
          <ul class="sidebar_menu">
            <li><a href="{{ route('profile.edit') }}" class="sidebar_menuItem"><i class="fa-solid fa-address-card"></i><span>プロフィール編集</span></a></li>
            <li>
              <form class="" action="{{ route('logout') }}" method="post">
              @csrf
                <button type="submit" class="sidebar_menuItem">
                  <i class="fa-solid fa-right-from-bracket"></i><span>ログアウト</span>
                </button>
              </form>
            </li>
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
@vite(['resources/js/jquery-3.6.0.min.js', 'resources/js/jquery.japan-map.min.js', 'resources/js/japan-map.js'])

@endsection

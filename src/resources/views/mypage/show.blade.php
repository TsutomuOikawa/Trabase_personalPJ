@extends('layouts.app')
@section('title', 'マイページ｜Trabase（トラベス）')
@section('headerScript')
  <!-- splide -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
@endsection
@section('content')

<main class="page-wrapper">
  <div class="container">
    <h1 class="container_title container_title--mypage">マイページ</h1>
    <div class="container_body container_body--col">
      <div class="mypage">
        <ul class="mypage_nav">
          <li class="mypage_navItem js-get-tab js-selected">MyMap</li>
          <li class="mypage_navItem js-get-tab">Notes</li>
          <li class="mypage_navItem js-get-tab">WishLists</li>
          <li class="mypage_navItem js-get-tab">Bookmarks</li>
        </ul>
        <div class="mypage_article">
          <section id="map" class="mypage_contents js-show-contents js-active">
            <p class="mypage_title">全国踏破まであと<span class="js-insert-progress"></span>県</p>
            <div class="js-japanMap"></div>

            @component('components.modal')
               @slot('modal_title')
                投稿済みのノート
               @endslot

               @slot('modal_content')
                <div class="js-insert-content"></div>
               @endslot

               @slot('modal_action')
                &gt 閉じる
               @endslot
            @endcomponent
          </section>
          <section id="notes" class="mypage_contents js-show-contents">
            <div class="list--note">
              <ul class="list_body--scrollNote js-get-visited">
                @component('components.notes',
                  ['notes' => $user->notes])
                @endcomponent
              </ul>
            </div>
          </section>
          <section id="wishLists" class="mypage_contents js-show-contents">
            <div class="list--wish">
              @component('components.wishLists',
                ['wishes' => $user->wishes, 'mine' => true])
              @endcomponent
            </div>
          </section>
          <section id="bookmarks" class="mypage_contents js-show-contents">
            <div class="list--note">
              <ul class="list_body--scrollNote">
                @component('components.notes',
                  ['notes' => $user->favoriteNotes])
                @endcomponent
              </ul>
            </div>
          </section>
        </div>
      </div>

      <div class="sidebar">
        <div class="sidebar_wrapper">
          <div class="sidebar_profile">
            <div class="userInfo userInfo--big">
              @if($user->avatar)
                <img src="{{ $user->avatar }}" class="userInfo_img userInfo_img--big" alt="{{ $user->name.'さんのプロフィール画像' }}">
              @endif
              <p class="userInfo_name userInfo_name--big">@if($user->name){{ $user->name }} @else 匿名ユーザー @endif</p>
              <p class="userInfo_intro">{{ $user->introduction }}</p>
            </div>
          </div>
          <ul class="sidebar_menu">
            <li><a href="{{ route('profile.edit') }}" class="sidebar_menuItem"><i class="fa-solid fa-user-gear"></i><span>プロフィール編集</span></a></li>
            <li>
              <form action="{{ route('logout') }}" method="post">
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
  </div>
  @component('components.slider',
   ['notes' => $user->notes])
  @endcomponent
</main>

@endsection
@section('script')
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
  @vite(['resources/js/jquery.japan-map.min.js', 'resources/js/japan-map.js'])
@endsection

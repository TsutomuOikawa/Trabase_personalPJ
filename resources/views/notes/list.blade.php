@extends('layouts.app')
@section('title', 'ノート一覧｜ Trabase（トラベス）')
@section('content')

    <main class="page-wrapper">
      <div class="container--note">
        <h1 class="container_title">
          @if($key['pref']) {{ $key['pref'] }} の @endif @if($key['key'])「{{ $key['key'] }}」を含む @endifノート一覧
        </h1>
        <div class="container_body--l">
          <div class="searchMenu">
            <div class="searchMenu_item">
              <p>検索結果：{{ $notes->total() }}件</p>
              <p>表示中：{{ ($notes->currentPage() -1) * $notes->perPage() + 1 }}~{{$notes->currentPage() * $notes->perPage()}}件/{{ $notes->total() }}件</p>
            </div>
            <div class="searchMenu_item">
              <div class="searchMenu_sort">
                <a href="/notes?pref={{$key['pref']}}&key={{$key['key']}}&sort=new" class="js-set-link">新着順</a>
                <span class="itemSeparater"></span>
                <a href="/notes?pref={{$key['pref']}}&key={{$key['key']}}&sort=bookmarks" class="js-set-link">ブックマーク数順</a>
                <span class="itemSeparater"></span>
                <a href="/notes?pref={{$key['pref']}}&key={{$key['key']}}&sort=comments" class="js-set-link">コメント数順</a>
              </div>
              <div>
                表示件数：
                <select class="searchMenu_showNum js-change-num">
                  <option value="10" @if(!isset($_GET['num']) || $_GET['num'] === '10') selected @endif>10件</option>
                  <option value="20" @if(isset($_GET['num']) && $_GET['num'] === '20') selected @endif>20件</option>
                  <option value="30" @if(isset($_GET['num']) && $_GET['num'] === '30') selected @endif>30件</option>
                </select>
              </div>
            </div>
          </div>
          <div class="list--note">
            <ul class="list_body--note">

            @foreach ($notes as $note)
              <li class="panel--note">
                <a href="{{ route('notes.article', ['note_id' => $note->note_id]) }}">
                  <p class="panel_pref js-get-links">{{ $note->pref_name }}</p>
                  <img src="{{ asset('img/IMG_5131.JPG') }}" class="panel_thumbnail" alt="">
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
                        @auth
                        <i class="fa-bookmark fa-lg @if($note->isFavorite) fa-solid js-active @else fa-regular @endif js-favorite"></i>
                        @endauth
                        @guest
                        <i class="fa-bookmark fa-lg fa-regular js-favorite"></i>
                        @endguest
                        <span class="iconBox_num">@if($note->favNum) {{ $note->favNum }} @else 0 @endif</span>
                        <i class="fa-regular fa-comment-dots fa-lg icon--comment"></i>
                        <span class="iconBox_num">@if($note->comNum) {{ $note->comNum }} @else 0 @endif</span>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
            @endforeach

            </ul>
          </div>
          {{ $notes->links() }}
        </div>
      </div>
    </main>

@endsection

@extends('layouts.app')
@section('title', 'ノート一覧｜ Trabase（トラベス）')
@section('content')
    <main class="page-wrapper">
      <div class="container--note">
        <h1 class="container_title">
          @if($key[0]) {{ $key[0] }}の @endif
          @if($key[1]) 「{{ $key[1] }}」を含む @endif ノート一覧
        </h1>
        <div class="container_body">
          <div class="searchMenu">
            <div class="searchMenu_item">
              <p>検索結果：{{ count($notes) }}件</p>
              <p>表示中：1~10件/{{ count($notes) }}件</p>
            </div>
            <div class="searchMenu_item">
              <div class="searchMenu_sort">
                <p href="#">新着順</p>
                <span class="itemSeparater"></span>
                <p>ブックマーク数順</p>
                <span class="itemSeparater"></span>
                <p>コメント数順</p>
              </div>
              <select class="searchMenu_appearNum">
                <option value="">表示件数：30件</option>
              </select>
            </div>
          </div>
          <div class="list--note">
            <ul class="list_body--note">

            @foreach ($notes as $note)
              <li class="panel--note">
                <a href="{{ route('notes.article', ['note_id' => $note->note_id]) }}">
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
        <div class="modal">
          <div class="modal-wrapper">
            <div class="modal_note">
              <div class="modal_thumbnail"></div>
              <div class="modal_body">
                <div class="panel_info">
                  <h3 class="panel_title">朝5時に家を出てから、18時間での熊本訪問</h3>
                  <div class="userInfo">
                    <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img userInfo_img--big" alt="">
                    <p class="userInfo_name userInfo_name--big">ユーザーネーム</p>
                  </div>
                  <p class="panel_postDay">2002/08/06投稿</p>
                  <div class="iconBox">
                    <i class="fa-regular fa-bookmark fa-lg icon--bookmark"></i>
                    <span class="iconBox_num">33</span>
                    <i class="fa-regular fa-comment-dots fa-lg icon--comment"></i>
                    <span class="iconBox_num">2</span>
                  </div>
                </div>
                <div class="modal_outline">
                  <div class="modal_chapter">
                    <h4>Chapter</h4>
                    <p class="modal_beginning">テキストテキストテキストテキストテキストテキスト</p>
                  </div>
                  <div class="modal_chapter">
                    <h4>Chapter</h4>
                    <p class="modal_beginning">テキストテキストテキストテキストテキストテキスト</p>
                  </div>
                  <div class="modal_chapter">
                    <h4>Chapter</h4>
                    <p class="modal_beginning">テキストテキストテキストテキストテキストテキスト</p>
                  </div>
                  <div class="modal_chapter">
                    <h4>Chapter</h4>
                    <p class="modal_beginning">テキストテキストテキストテキストテキストテキスト</p>
                  </div>
                </div>
              </div>
            </div>
            <span class="modal_action">&lt 戻る</span>
          </div>
          <div class="modal_cover"></div>
        </div>

      </div>
    </main>

@endsection

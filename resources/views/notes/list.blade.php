@extends('layouts.app')
@section('title', 'ノート一覧｜ Trabase（トラベス）')
@section('content')
    <main class="page-wrapper">
      <div class="container--note">
        <h1 class="container_title">書庫</h1>
        <div class="container_body">
          <div class="searchMenu">
            <div class="searchMenu_item">
              <p>検索結果：68件</p>
              <p>表示中：1~10件/68件</p>
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
                <img src="{{ asset('img/IMG_5131.JPG') }}" class="panel_thumbnail" alt="">
                <div class="panel_info">
                  <h3 class="panel_title">{{ $note->title }}</h3>
                  <div class="userInfo">
                    <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img" alt="">
                    <p class="userInfo_name">{{ $note->user->name }}</p>
                  </div>
                  <p class="panel_postDay">{{ date('y/m/d' ,strtotime($note->created_at)) }} 投稿</p>
                  <div class="iconBox">
                    <i class="fa-regular fa-bookmark fa-lg icon--bookmark"></i>
                    <span class="iconBox_num">33</span>
                    <i class="fa-regular fa-comment-dots fa-lg icon--comment"></i>
                    <span class="iconBox_num">2</span>
                  </div>
                </div>
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

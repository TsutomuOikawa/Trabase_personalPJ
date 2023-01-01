@extends('layouts.app')
@section('title', '｜Trabase（トラベス）')
@section('content')

    <main class="page-wrapper">
      <div class="container--note">
        <div class="container_body--l container_body--2col">
          <article class="note-wrapper">
            <section class="note">
              <img src="{{ asset('img/IMG_5131.jpg') }}" class="note_thumbnail" alt="">
              <h1 class="container_title">{{ $note->title }}</h1>
              <div class="note_subInfo">
                <p>投稿日：{{ date('y年m月d日', strtotime($note->created_at)); }}</p>
                <div class="iconBox">
                  <i class="fa-regular fa-bookmark fa-lg icon--bookmark"></i>
                  <span class="iconBox_num">33</span>
                </div>
              </div>
              <div class="note_text">
                @foreach($note->text['blocks'] as $text)
                  @if($text['type'] === 'header')
                    <h{{ $text['data']['level'] }} class="note_h{{ $text['data']['level'] }}">{{ $text['data']['text'] }}</h{{ $text['data']['level'] }}>
                  @elseif($text['type'] === 'paragraph')
                    <p class="note_paragraph">{!! $text['data']['text'] !!}</p>
                  @elseif($text['type'] === 'list')

                    @if($text['data']['style'] === 'ordered')
                      <ul style="list-style: decimal inside;">
                    @elseif($text['data']['style'] === 'unordered')
                      <ul style="list-style: disc inside;">
                    @endif
                      @foreach($text['data']['items'] as $num => $item)
                        <li>{{ $item }}</li>
                      @endforeach
                    </ul>
                  @endif
                @endforeach
              </div>
            </section>

            <section class="comments">
              <ul class="comments_list">
                <li class="comments_item">
                  <div class="userInfo">
                    <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img" alt="">
                    <p class="userInfo_name">ユーザーネーム</p>
                  </div>
                  <div class="comments_text">
                    コメントテキストコメントテキストコメントテキストコメントテキストコメントテキスト
                  </div>
                </li>
              </ul>
              <textarea name="name" class="comments_posting" rows="2"></textarea>
              <button type="submit" class="form_button">送信する</button>
            </section>

          </article>

          <div class="followingBtn">
            <i class="fa-solid fa-up-right-from-square"></i>
            <p>イキタイ！</p>
          </div>

          <div class="modal">
            <div class="modal-wrapper">
              <form class="modal_form form" action="" method="post">
                <p>イキタイ登録</p>
                <label>
                  <div class="form_name">
                    <span class="form_label form_label--required">必須</span>
                    都道府県
                  </div>
                  <select class="form_input" name="prefecture_id">
                    <option value="">熊本県</option>
                  </select>
                </label>
                <p class="form_errMsg"></p>

                <label>
                  <div class="form_name">
                    <span class="form_label form_label--required">必須</span>
                    どこで
                  </div>
                  <input type="text" name="where" class="form_input" value="">
                </label>
                <p class="form_errMsg"></p>

                <label>
                  <div class="form_name">
                    <span class="form_label form_label--optional">任意</span>
                    何をしたい？
                  </div>
                  <input type="text" name="what" class="form_input" value="">
                </label>
                <p class="form_errMsg"></p>
                <button type="submit" class="form_button" name="button">登録する</button>

              </form>
              <span class="modal_action">&lt 戻る</span>
            </div>
            <div class="modal_cover"></div>
          </div>

          <aside class="sidebar">
            <img src="{{ asset('img/IMG_5131.jpg') }}" class="sidebar_thumbnail" alt="">
            <div class="sidebar_contents">
              <p class="panel_title">{{ $note->title }}</p>
              <ul class="sidebar_chapters">
                <li><a href="#">Chapter 1</a></li>
                <li><a href="#">Chapter 2</a></li>
                <li><a href="#">Chapter 3</a></li>
                <li><a href="#">Chapter 4</a></li>
              </ul>

              <div class="sidebar_profile">
                <div class="userInfo userInfo--big">
                  <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img userInfo_img--big" alt="">
                  <p class="userInfo_name userInfo_name--big">{{ $note->user->name }}</p>
                </div>
              </div>

            </div>
          </aside>


        </div>
      </div>
    </main>

@endsection

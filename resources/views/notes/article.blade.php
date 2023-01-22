@extends('layouts.app')
@section('title', $note->title)
@section('content')

    <main class="page-wrapper">
      <div class="container--note">
        <div class="container_body--l container_body--col">
          <aside class="sidebar--icon">
            <div class="sidebar_wrapper">
              <i class="fa-bookmark @if($note->isFavorite) fa-solid js-active @else fa-regular @endif js-favorite" data-note_id="{{ $note->note_id }}"></i>
            </div>
            @if($note->user_id === Auth::id())
            <ul class="sidebar_wrapper">
              <li>
                <a href="{{ route('notes.edit', ['note_id'=>$note->note_id]) }}">
                  <i class="fa-solid fa-pen-to-square"></i>編集
                </a>
              </li>
              <li>
                <form action="{{ route('notes.delete', ['note_id'=>$note->note_id]) }}" method="post">
                  @csrf @method('DELETE')
                  <button type="submit">
                    <i class="fa-solid fa-trash-can"></i>削除
                  </button>
                </form>
              </li>
            </ul>
            @endif
          </aside>

          <article class="note">
            <section class="note_contents js-set-padding">
              <img src="{{ asset($note->thumbnail) }}" alt="" class="note_thumbnail js-get-height">
              <h1 class="note_title">{{ $note->title }}</h1>
              <div class="note_text">
                @foreach($note->text['blocks'] as $text)
                  @if($text['type'] === 'header')
                    <h{{ $text['data']['level'] }} id="{{ $text['data']['text'] }}" class="note_h{{ $text['data']['level'] }}">{{ $text['data']['text'] }}</h{{ $text['data']['level'] }}>
                  @elseif($text['type'] === 'paragraph')
                    <p class="note_paragraph">{!! $text['data']['text'] !!}</p>
                  @elseif($text['type'] === 'list')

                    @if($text['data']['style'] === 'ordered')
                      <ul class="note_list" style="list-style: decimal inside;">
                    @elseif($text['data']['style'] === 'unordered')
                      <ul class="note_list" style="list-style: disc inside;">
                    @endif
                      @foreach($text['data']['items'] as $item)
                        <li>{{ $item }}</li>
                      @endforeach
                    </ul>
                  @endif
                @endforeach
              </div>
            </section>

            <section class="comments">
              <p class="comments_title">コメント</p>
              <ul class="comments_list">
                @foreach($comments as $comment)
                <li class="comments_item">
                  <div class="userInfo">
                    <img src="{{ asset('img/プロフィールアイコン：有色.jpeg') }}" class="userInfo_img" alt="">
                    <p class="userInfo_name">{{ $comment->user->name }}</p>
                    <p class="userInfo_date">{{ date('y/m/d', strtotime($comment->created_at)); }}投稿</p>
                  </div>
                  <p class="comments_text">
                    {{ $comment->comment }}
                  </p>
                </li>
                @endforeach
              </ul>
              @auth
              <form action="{{ route('comment.storeComment', ['note_id' => $note->note_id]) }}" method="post">
                @csrf @method('POST')
                <textarea name="comment" class="comments_posting" rows="2" placeholder="感想・参考になったことなどをコメントしてみよう"></textarea>
                <button type="submit" class="form_button">送信する</button>
              </form>
              @endauth
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
            <div class="sidebar_wrapper">
              <div class="sidebar_profile">
                <div class="userInfo userInfo--big">
                  <img src="{{ asset($note->avatar) }}" class="userInfo_img userInfo_img--big" alt="">
                  <p class="userInfo_name userInfo_name--big">{{ $note->name }}</p>
                  <p class="userInfo_intro">{{ $note->intro }}</p>
                </div>
              </div>
              <p class="panel_title">{{ $note->title }}</p>
              <p class="panel_subInfo">{{ date('y/m/d', strtotime($note->created_at)); }} 投稿</p>
              <ul class="sidebar_chapters">
              @foreach($note->text['blocks'] as $text)
                @if($text['type'] === 'header')
                  <li><a href="#{{ $text['data']['text'] }}">{{ $text['data']['text'] }}</a></li>
                @endif
              @endforeach
              </ul>
            </div>
          </aside>

        </div>
      </div>
    </main>

@endsection

@extends('layouts.app')
@section('title', $data->pref_name )
@section('content')

<main>
  <section id="firstView" class="firstView js-header-change-target">
    <div class="firstView_container">
      <h1 class="firstView_title">{{ $data->pref_name }}</h1>
    </div>
  </section>

  <section id="information" class="container--subColor information">
    <h2 class="container_title">旅の情報</h2>
    <div class="container_body">
      <div class="list--wish">
        <h3 class="list_title">みんなの興味関心 in {{ $data->pref_name }}</h3>
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
      <div class="information_orderItems">
        <div class="information_now">
          <h3>{{ $data->pref_name }}の工事情報</h3>
          <div class="" style="height:100px; width:100%; background:white;">

          </div>
        </div>
        <div class="information_map">
          <h3>{{ $data->pref_name }}のマップ</h3>
          <div class="" style="height:100px; width:100%; background:white;">

          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="imgSlider">
    <ul class="imgSlider_list">
      @for($i=1; $i<=10; $i++)
      <li class="imgSlider_item"><img src="{{ asset('img/noimage.png') }}" class="imgSlider_img" alt=""></li>
      @endfor
    </ul>

  </div>
  <section id="note" class="container--note">
    <h2 class="container_title">{{ $data->pref_name }}の最新ノート</h2>
    <div class="container_body">
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
              <p class="panel_postDay">{{ date('y/m/d', strtotime($note->created_at)) }}投稿</p>
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
  <section id="changeDestination" class="container changeDestination">
    <h2 class="container_title">行き先を変える</h2>
    <div class="container_body">
      <div class="list--destination">
        <h3 class="list_title">北海道・東北</h3>
        <div class="list_body--destination">
          @foreach($prefs as $pref)
          <a href="{{ route('pref', ['pref_id' => $pref->pref_id]) }}" class="panel--destination">
            <img src="{{ asset('img/IMG_3930.JPG') }}" class="panel_destImg" alt="">
            <span class="panel_destCover"></span>
            <span class="panel_destName">{{ $pref->pref_name }}</span>
          </a>

          @switch($pref->pref_id)
          @case(7)
        </div>
        <h3 class="list_title">関東</h3>
        <div class="list_body--destination">
          @break
          @case(14)
        </div>
        <h3 class="list_title">中部</h3>
        <div class="list_body--destination">
          @break
          @case(23)
        </div>
        <h3 class="list_title">近畿</h3>
        <div class="list_body--destination">
          @break
          @case(30)
        </div>
        <h3 class="list_title">中国</h3>
        <div class="list_body--destination">
          @break
          @case(35)
        </div>
        <h3 class="list_title">四国</h3>
        <div class="list_body--destination">
          @break
          @case(39)
        </div>
        <h3 class="list_title">九州・沖縄</h3>
        <div class="list_body--destination">

          @default
          @endswitch
          @endforeach
        </div>
      </div>
    </div>
  </section>

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

</main>

@endsection

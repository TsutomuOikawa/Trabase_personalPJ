@extends('layouts.app')
@section('title', $data->pref_name)
@section('content')

<!-- <script src="https://maps.googleapis.com/maps/api/js?language=ja&key=key&callback=initMap" defer></script> -->
<main>
  <section class="hero js-header-change-target">
    <section class="firstView">
      <h1 class="firstView_title--big js-hide-title">{{ $data->pref_name }}</h1>
    </section>
    <section id="informations" class="container--transparent informations">
      <h2 class="container_title">旅の情報</h2>
      <div class="container_body">
        <div class="list--wish">
          <h3 class="list_title">{{ $data->pref_name }}の人気スポット・体験</h3>
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
                  <td>{{ $wish->spot }}</td>
                </tr>
                <tr class="panel_tableElm">
                  <th>WHAT</th>
                  <td>{{ $wish->thing }}</td>
                </tr>
              </table>
              <i class="fa-sharp fa-solid fa-lightbulb js-show-modal"></i>
            </li>
            @endforeach
            @empty($wishes[0])
            <p>現在登録されているウィッシュリストはありません</p>
            @endempty
          </ul>
        </div>

        <div class="informations_orderItems">
          <div class="informations_item">
            <h3 class="list_title">工事中のスポット・注意情報</h3>
            <div class="" style="background:white;">

            </div>
          </div>
          <div class="informations_item">
            <h3 class="list_title">{{ $data->pref_name }}のマップ</h3>
            <div class="">
              <div id="googleMap"></div>
            </div>

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
    </section>



  </section>

  <section id="prefNotes" class="prefNotes container--note">
    <h2 class="container_title">{{ $data->pref_name }}の最新の記録</h2>
    <div class="container_body">
      <div class="list--note">
        <ul class="list_body--note">
          @foreach($notes as $note)
          <li class="panel--note">
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
    </div>
  </section>
  <section id="destination" class="container--baseColor destination js-change-back-target">
    <h2 class="container_title">行き先を変える</h2>
    <div class="container_body">
      <div class="list--destination">
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-minus"></i>北海道・東北</h3>
        <div class="list_body--destination js-toggle-list active">
          @foreach($prefs as $pref)
          <a href="{{ route('pref', ['pref_id' => $pref->pref_id]) }}" class="panel--destination js-change-back">
            <img src="{{ asset('img/IMG_3930.JPG') }}" class="panel_destImg" alt="">
            <span class="panel_destCover">
              <span class="panel_destName">{{ $pref->pref_name }}</span>
            </span>
          </a>

          @switch($pref->pref_id)
          @case(7)
        </div>
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-plus"></i>関東</h3>
        <div class="list_body--destination js-toggle-list">
          @break
          @case(14)
        </div>
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-plus"></i>北陸・甲信越</h3>
        <div class="list_body--destination js-toggle-list">
          @break
          @case(20)
        </div>
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-plus"></i>東海</h3>
        <div class="list_body--destination js-toggle-list">
          @break
          @case(24)
        </div>
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-plus"></i>近畿</h3>
        <div class="list_body--destination js-toggle-list">
          @break
          @case(30)
        </div>
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-plus"></i>中国・四国</h3>
        <div class="list_body--destination js-toggle-list">
          @break
          @case(39)
        </div>
        <h3 class="list_title js-switch-toggle-list"><i class="fa-regular fa-square-plus"></i>九州・沖縄</h3>
        <div class="list_body--destination js-toggle-list">

          @default
          @endswitch
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <div class="followingBtn js-show-modal">
    <i class="fa-solid fa-lightbulb"></i>
    <p>イキタイ！</p>
  </div>

  <div class="modal js-modal">
    <div class="modal_content">
      <p class="modal_header">イキタイ！登録</p>
      @auth
      <form class="form" action="{{ route('wish.storeWish') }}" method="post">
        @csrf
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            都道府県
          </div>
          <select name="pref_id" class="form_input @error('pref_id') form_input--err @enderror js-get-note-pref" >
          @foreach($prefs as $pref)
            <option value="{{ $pref->pref_id }}" @if(old('pref_id') === $pref->pref_id) selected @elseif($data->pref_id === $pref->pref_id) selected @endif>{{ $pref->pref_name }}</option>
          @endforeach
          </select>
        </label>
        <p class="form_errMsg"></p>

        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            どこで
          </div>
          <input type="text" name="place" class="form_input" value="" placeholder="富士山">
        </label>
        <p class="form_errMsg"></p>

        <label>
          <div class="form_name">
            <span class="form_label form_label--optional">任意</span>
            何をしたい？
          </div>
          <input type="text" name="thing" class="form_input" value="" placeholder="山頂でご来光をみたい！">
        </label>
        <p class="form_errMsg"></p>
        <button type="submit" class="form_button" name="button">登録する</button>

      </form>
      @endauth
      <p class="modal_action js-hide-modal">&lt 戻る</p>
    </div>
    <div class="modal_cover"></div>
  </div>

</main>

@endsection

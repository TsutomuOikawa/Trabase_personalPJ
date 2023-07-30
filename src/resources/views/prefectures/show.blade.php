@extends('layouts.app')
@section('title', $prefecture->name)
@section('headerScript')
  <!-- splide -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
  <!-- GoogleMap API -->
  @vite('resources/js/google-map.js')
  <script src="https://maps.googleapis.com/maps/api/js?language=ja&key={{ config('googlemap.api_key') }}&callback=initMap" defer></script>
@endsection

@section('content')
<main>
  <section class="hero js-set-back" style="background-image: url( {{ Storage::disk('s3')->url('assets/hero/'.$prefecture->name.'.jpg') }} );">
    <div class="js-header-change-target">
      <section class="firstView">
        <h1 class="firstView_title--big js-hide-title">{{ $prefecture->name }}</h1>
      </section>
      <section id="informations" class="container--transparent informations">
        <h2 class="container_title">旅の情報</h2>
        <div class="container_body">
          <div class="list--wish">
            <h3 class="list_title">{{ $prefecture->name }}の人気スポット・体験</h3>
            @component('components.wishLists',
              ['wishes' => $prefecture->wishes, 'mine' => false])
            @endcomponent
          </div>
          <div class="informations_map">
            <h3 class="list_title">{{ $prefecture->name }}のマップ</h3>
            <div id="googleMap" class="informations_google"></div>
          </div>
        </div>
      </section>
    </div>
    @component('components.slider',
        ['prefecture' => $prefecture])
    @endcomponent
  </section>
  <section id="prefNotes" class="prefNotes container">
    <h2 class="container_title">{{ $prefecture->name }}の最新の記録</h2>
    <div class="container_body">
      <div class="list--note">
        <ul class="list_body--note">
          @component('components.notes',
            ['notes' => $prefecture->notes])
          @endcomponent
        </ul>
      </div>
    </div>
  </section>
  <section id="destination" class="container--baseColor destination js-change-back-target">
    <h2 class="container_title">行き先を変える</h2>
    <div class="container_body">
      @component('components.destinations',
        ['tag' => 'h3', 'prefectures' => $prefectures])
      @endcomponent
    </div>
  </section>
  <div class="followingBtn js-show-modal">
    <i class="fa-solid fa-lightbulb"></i>
    <p>イキタイ！</p>
  </div>

  @component('components.modal')
     @slot('modal_title')
      @auth マイリスト登録 @endauth
      @guest マイリスト登録はログイン後にご利用いただけます @endguest
     @endslot

     @slot('modal_content')
        @auth
       <form class="modal_form form" action="{{ route('wish.storeWish') }}" method="post">
         @csrf
         <label>
           <div class="form_name">
             <span class="form_label form_label--required">必須</span>
             都道府県
           </div>
           <select name="prefecture_id" class="form_input @error('prefecture_id') form_input--err @enderror js-get-note-pref" >
           @foreach($prefectures as $pref)
              <option value="{{ $pref['id'] }}" @if(old('prefecture_id') === $pref['id']) selected @elseif($prefecture->id === $pref['id']) selected @endif>{{ $pref['name'] }}</option>
           @endforeach
           </select>
         </label>
         <p class="form_errMsg"></p>
         <label>
           <div class="form_name">
             <span class="form_label form_label--required">必須</span>
             どこで
           </div>
           <input type="text" name="spot" class="form_input" value="{{ old('spot') }}" placeholder="富士山の山頂">
         </label>
         <p class="form_errMsg"></p>
         <label>
           <div class="form_name">
             <span class="form_label form_label--optional">任意</span>
             何をしたい？
           </div>
           <input type="text" name="thing" class="form_input" value="{{ old('thing') }}" placeholder="ご来光をみたい">
         </label>
         <p class="form_errMsg"></p>
         <button type="submit" class="form_button" name="button">登録する</button>
       </form>
       @endauth
       @guest
       <a href="{{ route('login') }}" class="modal_header">&gt ログインはこちら</a>
       @endguest

     @endslot

     @slot('modal_action')
      &gt 閉じる
     @endslot
  @endcomponent

</main>
@endsection

@section('script')
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
@endsection

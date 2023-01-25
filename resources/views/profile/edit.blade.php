@extends('layouts.app')
@section('title', 'プロフィール編集｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container--baseColor">
    <h1 class="container_title">プロフィール編集</h1>
    <ul class="carousel_nav">
      <li class="carousel_navItem js-switch-carousel01 active">
        <span><i class="fa-solid fa-user carousel_icon"></i></span>
        <p>プロフィール</p>
      </li>
      <li class="carousel_navItem js-switch-carousel02 nonactive">
        <span><i class="fa-solid fa-key carousel_icon"></i></span>
        <p>パスワード変更</p>
      </li>
      <li class="carousel_navItem js-switch-carousel03 nonactive">
        <span><i class="fa-solid fa-user-xmark carousel_icon"></i></span>
        <p>退会</p>
      </li>
    </ul>
    <div class="carousel">
      <div class="carousel_wrapper js-move-position">
        <div class="carousel_item">
          <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form">
            @csrf
            @method('patch')
            <label>
              <div class="form_name">
                <span class="form_label form_label--optional">任意</span>
                ユーザーネーム
              </div>
              <input type="text" name="name" class="form_input @error('name') form_input--err @enderror" value="@if(old('name')) {{ old('name') }} @else {{ $user->name }} @endif">
            </label>
            <p class="form_errMsg">{{ $errors->first('name') }}</p>
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                メールアドレス
              </div>
              <input type="text" name="email" class="form_input @error('email') form_input--err @enderror" value="@if(old('email')) {{ old('email') }} @else {{ $user->email }} @endif">
            </label>
            <p class="form_errMsg">{{ $errors->first('email') }}</p>
            <label>
              <div class="form_name">
                <span class="form_label form_label--optional">任意</span>
                プロフィール画像
              </div>
              @if($user->avatar)
              <img src="{{ asset($user->avatar) }}" class="form_avatar">
              @endif
              <input type="file" name="avatar" class="@error('avatar') form_input--err @enderror" value="">
            </label>
            <p class="form_errMsg">{{ $errors->first('avatar') }}</p>
            <label>
              <div class="form_name">
                <span class="form_label form_label--optional">任意</span>
                コメント
              </div>
              <input type="text" name="intro" class="form_input @error('intro') form_input--err @enderror" value="@if(old('intro')) {{ old('intro') }} @else {{ $user->intro }} @endif">
            </label>
            <p class="form_errMsg">{{ $errors->first('intro') }}</p>
            <button type="submit" class="form_button" name="">更新する</button>
          </form>
        </div>
        <div class="carousel_item">
          <form action="{{ route('password.update') }}" method="post" class="form">
            @csrf
            @method('put')
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                現在のパスワード
              </div>
              <input type="password" name="current_password" class="form_input @if($errors->updatePassword->first('current_password')) form_input--err @endif">
            </label>
            <p class="form_errMsg">{{ $errors->updatePassword->first('current_password') }}</p>
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                新しいパスワード
              </div>
              <input type="password" name="password" class="form_input @if($errors->updatePassword->first('password')) form_input--err @endif">
            </label>
            <p class="form_errMsg">{{ $errors->updatePassword->first('password') }}</p>
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                パスワード再入力
              </div>
              <input type="password" name="password_confirmation" class="form_input @if($errors->updatePassword->first('password_confirmation')) form_input--err @endif">
            </label>
            <p class="form_errMsg">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            <button type="submit" class="form_button">変更する</button>
          </form>
        </div>
        <div class="carousel_item">
          <div class="form">
            <button type="button" class="form_button js-show-modal">退会する</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<div class="modal js-modal">
  <div class="modal_content">
    <form action="{{ route('profile.destroy') }}" method="post" class="form">
      @csrf
      @method('delete')
      <label>
        <div class="form_name">
          <span class="form_label form_label--required">必須</span>
          パスワード確認
        </div>
        <input type="password" name="password" class="form_input @error('password') form_input--err @enderror" value="">
      </label>
      <p class="form_errMsg">@error('password') {{ $message }} @enderror</p>
      <button type="submit" class="form_button" name="">退会する</button>
    </form>
    <p class="modal_action js-hide-modal">&gt; 閉じて戻る</p>
  </div>
  <div class="modal_cover"></div>
</div>

@endsection
@section('script')
  @vite('resources/js/app.js')
@endsection

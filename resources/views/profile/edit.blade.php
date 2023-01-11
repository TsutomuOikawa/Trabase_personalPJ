@extends('layouts.app')
@section('title', 'プロフィール編集｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container--baseColor">
    <h1 class="container_title">プロフィール編集</h1>
    {{ var_dump($errors) }}
    <div class="container_body--xs">
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
      <div class="carousel js-set-height">
        <div class="carousel_container js-move-position">
          <form method="post" action="{{ route('profile.update') }}" class="form carousel_item">
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
              <input type="text" name="image" class="form_input @error('image') form_input--err @enderror" value="">
            </label>
            <p class="form_errMsg">{{ $errors->first('image') }}</p>
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

          <form action="{{ route('password.update') }}" method="post" class="form carousel_item">
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

          <div class="form carousel_item">
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

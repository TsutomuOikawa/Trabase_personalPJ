@extends('layouts.app')
@section('title', 'プロフィール編集｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container--baseColor">
    <h1 class="container_title">プロフィール編集</h1>
    <div class="container_body--xs container_body--carousel">

      <form method="post" action="{{ route('profile.update') }}" class="form form--carousel">
        @csrf
        @method('patch')

        <label>
          <div class="form_name">
            <span class="form_label form_label--optional">任意</span>
            ユーザーネーム
          </div>
          <input type="text" name="name" class="form_input @error('name') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('name') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            メールアドレス
          </div>
          <input type="text" name="email" class="form_input @error('email') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('email') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--optional">任意</span>
            プロフィール画像
          </div>
          <input type="text" name="image" class="form_input @error('image') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('image') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">任意</span>
            コメント
          </div>
          <input type="text" name="text" class="form_input @error('text') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('text') {{ $message }} @enderror</p>
        <button type="submit" class="form_button" name="">更新して終わる</button>
      </form>

      <form action="{{ route('password.update') }}" method="post" class="form form--carousel">
        @csrf
        @method('put')
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            現在のパスワード
          </div>
          <input type="password" name="current_password" class="form_input @error('current_password') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('current_password') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            新しいパスワード
          </div>
          <input type="password" name="password" class="form_input @error('password') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('password') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            パスワード再入力
          </div>
          <input type="password" name="password_confirmation" class="form_input @error('password_confirmation') form_input--err @enderror" value="">
        </label>
        <p class="form_errMsg">@error('password_confirmation') {{ $message }} @enderror</p>
        <button type="submit" class="form_button" name="">更新して終わる</button>
      </form>

      <div class="form form--carousel">
        <button type="button" class="form_button">退会する（モーダルを開く）</button>
      </div>

      <form action="{{ route('profile.destroy') }}" method="post" class="form form--carousel">
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
        <button type="submit" class="form_button" name="">更新して終わる</button>
      </form>

    </div>
  </div>
</main>

@endsection

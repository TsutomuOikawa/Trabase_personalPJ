@extends('layouts.app')
@section('title', '会員登録｜Trabase(トラベス)')
@section('headerScript')
@endsection
@section('content')

<main class="page-wrapper">
  <div class="container--baseColor">
    <h1 class="container_title">会員登録（無料）</h1>
    <div class="container_body--xs">
      <form method="POST" action="{{ route('register') }}" class="form">
      @csrf
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            メールアドレス
          </div>
          <input type="text" name="email" class="form_input @error('email') form_input--err @enderror" value="{{ old('email') }}" placeholder="example@test.com">
        </label>
        <p class="form_errMsg">@error('email') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            パスワード
            <span class="smallfont">（半角英数字6文字以上）</span>
          </div>
          <input type="password" name="password" class="form_input @error('password') form_input--err @enderror" value="{{ old('password') }}">
        </label>
        <p class="form_errMsg">@error('password') {{ $message }} @enderror</p>
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            パスワード再入力
          </div>
          <input type="password" name="password_confirmation" class="form_input @error('password_confirmation') form_input--err @enderror">
        </label>
        <p class="form_errMsg">@error('password_confirmation') {{ $message }} @enderror</p>
        <button type="submit" class="form_button" name="">登録する</button>
        <p class="form_notion"><a href="{{ route('login') }}" class="link">&gt 登録済みの方はこちら</a></p>
      </form>
    </div>
  </div>
</main>
@endsection

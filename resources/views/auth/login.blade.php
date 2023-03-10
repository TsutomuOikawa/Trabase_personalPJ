@extends('layouts.app')
@section('title', 'ログイン｜Trabase(トラベス)')
@section('content')

    <main class="page-wrapper">
      <div class="container--baseColor">
        <h1 class="container_title">ログイン</h1>
        <div class="container_body">
          <form method="POST" action="{{ route('login') }}" class="form">
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

            <label class="smallfont">
              <input type="checkbox" name="remember">ログイン状態を保存する
            </label>
            <button type="submit" class="form_button">ログインする</button>
            <div class="form_notion">
              <p><a href="{{ route('password.request') }}" class="link">&gt パスワードをお忘れの方はこちら</a></p>
              <p><a href="{{ route('register') }}" class="link">&gt ご登録がお済みでない方はこちら</a></p>
            </div>
          </form>
        </div>
      </div>
    </main>
@endsection

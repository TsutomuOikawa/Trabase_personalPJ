@extends('layouts.app')
@section('title', 'パスワードの再設定｜Trabase（トラベス）')
@section('content')

<main class="page-wrapper">
  <div class="container--baseColor">
    <h1 class="container_title">パスワードの再設定</h1>
    <p class="container_notion">ご登録のメールアドレス宛に<br>再設定用リンクをお送りします</p>
    <div class="container_body--xs">
      <form method="post" action="{{ route('password.email') }}" class="form">
        @csrf
        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            メールアドレス
          </div>
          <input type="text" name="email" class="form_input" value="" placeholder="example@test.com">
        </label>
        <p class="form_errMsg"></p>
        <button type="submit" class="form_button" name="">メールを送る</button>
        <p class="form_notion"><a href="{{ route('login') }}" class="link">&gt ログインフォームへ戻る</a></p>
        <p class="form_notion"><a href="{{ route('register') }}" class="link">&gt ご登録がお済みでない方はこちら</a></p>
      </form>
    </div>
  </div>
</main>

@endsection

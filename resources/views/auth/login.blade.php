@extends('layouts.app')
@section('title', 'ログイン｜Trabase(トラベス)')
@section('content')

    <main class="page-wrapper">
      <div class="container--baseColor">
        <h1 class="container_title">ログイン</h1>
        <div class="container_body--xs">
          <form method="POST" action="{{ route('login') }}" class="form">
          @csrf
          <h2 class="form_title">ご登録情報を入力してください</h2>
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                メールアドレス
              </div>
              <input type="text" name="email" class="form_input @error('email') form_input--err @enderror" value="" placeholder="example@test.com">
            </label>
            <p class="form_errMsg">@error('email') {{ $message }} @enderror</p>

            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                パスワード
                <span class="smallfont">（半角英数字6文字以上）</span>
              </div>
              <input type="password" name="password" class="form_input @error('password') form_input--err @enderror" value="">
            </label>
            <p class="form_errMsg">@error('password') {{ $message }} @enderror</p>

            <label>
              <div class="form_notion">
                <input type="checkbox" name="remember" value="">
                <span class="smallfont">{{ __('Remember me') }}</span>
              </div>
            </label>
            <button type="submit" class="form_button" name="">ログインする</button>
            <p class="form_notion"><a href="passRemindSend.php" class="link"><span style="font-size:18px;">&gt</span> パスワードをお忘れの方はこちら</a></p>
            <p class="form_notion"><a href="register.php" class="link"><span style="font-size:18px;">&gt</span> ご登録がお済みでない方はこちら</a></p>
          </form>
        </div>
      </div>
    </main>
@endsection

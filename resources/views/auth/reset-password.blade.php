@extends('layouts.app')
@section('title', 'パスワードの再登録｜Trabase(トラベス)')
@section('content')

    <main class="page-wrapper">
      <div class="container--baseColor">
        <h1 class="container_title">パスワードの再登録</h1>
        <div class="container_body">
          <form method="POST" action="{{ route('password.store') }}" class="form">
          @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                メールアドレス
              </div>
              <input type="text" name="email" class="form_input @error('email') form_input--err @enderror" value="{{ old('email', $request->email) }}" placeholder="example@test.com">
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
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                パスワード再入力
              </div>
              <input type="password" name="password_confirmation" class="form_input @error('password_confirmation') form_input--err @enderror" value="">
            </label>
            <p class="form_errMsg">@error('password_confirmation') {{ $message }} @enderror</p>
            <button type="submit" class="form_button">パスワードを変更</button>
          </form>
        </div>
      </div>
    </main>
@endsection

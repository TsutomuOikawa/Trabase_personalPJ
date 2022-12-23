@extends('layouts.app')
@section('title', '会員登録｜Trabase(トラベス)')
@section('content')

<main class="page-wrapper">
  <div class="container--baseColor">
    <h1 class="container_title">会員登録（無料）</h1>
    <div class="container_body--xs">
      <form method="POST" action="{{ route('register') }}" class="form">
      @csrf

      <h2 class="form_title">ご登録フォーム</h2>

        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            メールアドレス
          </div>
          <input type="text" name="email" class="form_input" value="" placeholder="example@test.com">
        </label>
        <p class="form_errMsg"></p>

        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            パスワード
            <span class="smallfont">（半角英数字6文字以上）</span>
          </div>
          <input type="password" name="pass" class="form_input" value="">
        </label>
        <p class="form_errMsg"></p>

        <label>
          <div class="form_name">
            <span class="form_label form_label--required">必須</span>
            パスワード再入力
          </div>
          <input type="password" name="pass_re" class="form_input" value="">
        </label>
        <p class="form_errMsg"></p>

        <button type="submit" class="form_button" name="">登録する</button>

        <p class="form_notion"><a href="login.php" class="link"><span style="font-size:18px;">&gt</span> 登録済みの方はこちら</a></p>


  

          <!-- Email Address -->
          <div class="mt-4">
              <x-input-label for="email" :value="__('Email')" />
              <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mt-4">
              <x-input-label for="password" :value="__('Password')" />

              <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

              <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Confirm Password -->
          <div class="mt-4">
              <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

              <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required />

              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>

          <div class="flex items-center justify-end mt-4">
              <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                  {{ __('Already registered?') }}
              </a>

              <x-primary-button class="ml-4">
                  {{ __('Register') }}
              </x-primary-button>
          </div>
      </form>
@endsection

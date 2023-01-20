<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')｜Trabase（トラベス）</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- GoogleMap API -->
    <!-- <script type="module" src="http://0.0.0.0:5173/resources/js/google-map.js"></script> -->
    <!-- Scripts -->
    @vite(['resources/css/reset.css', 'resources/icon/css/all.css', 'resources/sass/app.scss'])
  </head>

  <body>
    @if($_SERVER['PHP_SELF'] === '/index.php'|| strpos($_SERVER['PHP_SELF'], 'index.php/pref/'))
    <header id="header" class="header js-change-header js-transparent">
    @else
    <header id="header" class="header">
    @endif
      <div class="header_inner">
        <a href="{{ route('index') }}" class="header_logo">Trabase</a>
        @if($_SERVER['PHP_SELF'] === '/index.php'|| strpos($_SERVER['PHP_SELF'], 'index.php/pref/'))
        <form action="{{ route('notes.list') }}" method="get" class="header_form js-change-header_form js-nonactive">
        @else
        <form action="{{ route('notes.list') }}" method="get" class="header_form">
        @endif
          <input type="text" name="pref" class="header_input" value="" placeholder="都道府県名を入力">
          <input type="text" name="key" class="header_input" value="" placeholder="キーワードを入力">
          <button type="submit" class="header_submit" name=""><i class="fas fa-search fa-lg"></i></button>
        </form>
        <div class="header_sp">
          <button type="button" class="header_search js-form-trigger"><i class="fa-solid fa-magnifying-glass"></i></i></button>
          <div class="header_humburger js-menu-trigger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <nav class="header_menu js-slide-menu">
          @guest
          <ul class="menu">
            <li class="menu_item"><a href="{{ route('index', ['#about']) }}" class="menu_item_link">About</a></li>
            <li class="menu_item"><a href="{{ route('login') }}" class="menu_item_link">Login</a></li>
            <li class="menu_item"><a href="{{ route('register') }}" class="menu_item_link">Register</a></li>
          </ul>
          @endguest

          @auth
          <ul class="menu">
            <li class="menu_item"><a href="{{ route('notes.new') }}" class="menu_item_link">TakeNotes</a></li>
            <li class="menu_item"><a href="{{ route('mypage') }}" class="menu_item_link">Mypage</a></li>
          </ul>
          @endauth
        </nav>
      </div>
    </header>

    @if(session('session_success'))
    <!-- Session Message -->
    <div class="flashMsg flashMsg--success js-show-flashMsg">
      <p class="flashMsg_text js-get-flashMsg">{{ session('session_success') }}</p>
    </div>
    @endif
    <!-- Page Content -->
    @yield('content')

    <footer id="footer" class="footer">
      <div class="footer_wrapper">
        <nav class="footer_nav">
          <div class="footer_navItem">
            <p class="footer_category">運営</p>
            <ul>
              <li class="footer_detail"><a href="https://github.com/TsutomuOikawa">運営者情報</a></li>
              <li class="footer_detail">利用規約</li>
            </ul>
          </div>
          <div class="footer_navItem">
            <p class="footer_category">ノート</p>
            <ul>
              <li class="footer_detail"><a href="{{ route('notes.list') }}">一覧ページ</a></li>
              <li class="footer_detail"><a href="{{ route('notes.new') }}">投稿ページ</a></li>
            </ul>
          </div>
          <div class="footer_navItem">
            <p class="footer_category js-show-prefs">エリア別情報</p>
            <table class="footer_spHide">
              <tbody>
                <tr>
                  <th>北海道・東北地方</th>
                  @foreach($prefs as $pref)
                  <td><a href="{{ route('pref', ['pref_id' => $pref->pref_id]) }}">{{ $pref->pref_name }}</a></td>
                @switch($pref->pref_id)
                @case(7)
                </tr>
                <tr>
                  <th>関東地方</th>
                @break
                @case(14)
                </tr>
                <tr>
                  <th>北陸・甲信越地方</th>
                @break
                @case(20)
                </tr>
                <tr>
                  <th>東海地方</th>
                @break
                @case(24)
                </tr>
                <tr>
                  <th>近畿地方</th>
                @break
                @case(30)
                </tr>
                <tr>
                  <th>中国・四国地方</th>
                @break
                @case(39)
                </tr>
                <tr>
                  <th>九州・沖縄地方</th>
                @default
                @endswitch
                @endforeach
                </tr>
              </tbody>
            </table>
          </div>
          <div class="footer_navItem">
            <p class="footer_category">お問い合せ</p>
            <textarea name="inquiry" class="footer_form"></textarea>
            <button type="submit" class="footer_submit">送信する</button>
          </div>
        </nav>
        <small class="footer_copyright"> Copyright @ Trabase <br>All Rights Reserved</small>
      </div>
    </footer>
    @vite(['resources/js/jquery-3.6.0.min.js', 'resources/js/app.js'])

  </body>
</html>

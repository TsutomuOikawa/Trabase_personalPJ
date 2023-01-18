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
    <header id="header" class="header js-change-header @if(strpos($_SERVER['PHP_SELF'],'index.php')||strpos($_SERVER['PHP_SELF'],'prefectures.php')) active @endif">
      <div class="header-wrapper">
        <a href="{{ route('index') }}" class="header_logo">Trabase</a>
        <form action="{{ route('notes.list') }}" method="get" class="header_form js-change-header_form @if(strpos($_SERVER['PHP_SELF'],'index.php')||strpos($_SERVER['PHP_SELF'],'prefectures.php')) nonactive @endif">
          <input type="text" name="pref" class="header_input" value="" placeholder="都道府県名を入力">
          <input type="text" name="key" class="header_input" value="" placeholder="キーワードを入力">
          <button type="submit" class="header_submit" name=""><i class="fas fa-search fa-lg"></i></button>
        </form>
        <div class="header_humburger js-menu-trigger">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <nav class="header_menu">
          <ul class="menu">
            <li class="menu_item"><a href="index.php#about" class="menu_item_link">About</a></li>
            <li class="menu_item--sp"><a href="index.php#about" class="menu_item_link">Search Destination</a></li>
            <li class="menu_item"><a href="{{ route('login') }}" class="menu_item_link">Login</a></li>
            <li class="menu_item"><a href="{{ route('register') }}" class="menu_item_link">Register</a></li>
          </ul>
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
      <small class="footer_copyright"> Copyright @ GlobeNote <br>All Rights Reserved</small>
    </footer>
    @vite(['resources/js/jquery-3.6.0.min.js', 'resources/js/app.js'])

  </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ Storage::disk('s3')->url('assets/trabase_favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>@yield('title')｜Trabase（トラベス）</title>
    @yield('headerScript')
    <!-- Scripts -->
    @vite(['resources/css/reset.css', 'resources/sass/app.scss'])
  </head>

  <body>
    @if($_SERVER['REQUEST_URI'] === '/'|| strpos($_SERVER['REQUEST_URI'], 'pref/'))
    <header id="header" class="header js-change-header js-transparent">
    @else
    <header id="header" class="header">
    @endif
      <div class="header_inner">
        <a href="{{ route('index') }}" class="header_logo"><img src="{{ Storage::disk('s3')->url('assets/trabase_logo.png') }}" class="header_logo_img" alt="Trabaseのロゴ画像"></a>
        @if($_SERVER['REQUEST_URI'] === '/'|| strpos($_SERVER['REQUEST_URI'], 'pref/'))
        <form action="{{ route('notes.list') }}" method="get" class="header_form js-change-header_form js-nonactive">
        @else
        <form action="{{ route('notes.list') }}" method="get" class="header_form">
        @endif
          <input type="text" name="pref" class="header_input" value="" placeholder="都道府県名を入力">
          <input type="text" name="key" class="header_input" value="" placeholder="キーワードを入力">
          <button type="submit" class="header_submit" name=""><i class="fa-solid fa-search fa-lg"></i></button>
        </form>
        <div class="header_sp">
          <button type="button" class="header_search js-form-trigger"><i class="fa-solid fa-magnifying-glass"></i></button>
          <div class="header_humburger js-menu-trigger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <nav class="header_menu js-slide-menu">
          @guest
          <ul class="menu">
            <li class="menu_item"><a href="/#about" class="menu_item_link"><i class="fa-solid fa-book-open"></i>About</a></li>
            <li class="menu_item"><a href="{{ route('login') }}" class="menu_item_link"><i class="fa-solid fa-right-to-bracket"></i>Login</a></li>
            <li class="menu_item"><a href="{{ route('register') }}" class="menu_item_link"><i class="fa-solid fa-user-plus"></i>Register</a></li>
          </ul>
          @endguest

          @auth
          <ul class="menu">
            <li class="menu_item"><a href="{{ route('notes.new') }}" class="menu_item_link"><i class="fa-solid fa-pen-to-square fa-lg"></i>TakeNotes</a></li>
            <li class="menu_item"><a href="{{ route('mypage') }}" class="menu_item_link"><i class="fa-solid fa-user"></i>Mypage</a></li>
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
              <!-- <li class="footer_detail">利用規約</li> -->
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
            <textarea name="inquiry" class="footer_form">現在はご利用いただけません</textarea>
            <button type="button" class="footer_submit">送信する</button>
          </div>
        </nav>
        <small class="footer_copyright"> Copyright @ Trabase <br>All Rights Reserved </small>
      </div>
    </footer>
  </body>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  @yield('script')
  @vite('resources/js/app.js')
</html>

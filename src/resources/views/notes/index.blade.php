@extends('layouts.app')
@section('title', 'ノート一覧｜ Trabase（トラベス）')
@section('content')

    <main class="page-wrapper">
      <div class="container--baseColor">
        <h1 class="container_title">
          @if(request()->query('pref')) {{ request()->query('pref') }} の @endif @if(request()->query('keyword'))「{{ request()->query('keyword') }}」を含む @endifノート一覧
        </h1>
        <div class="container_body--l">
          <div class="searchMenu">
            <div class="searchMenu_item">
              <p>検索結果：{{ $notes->total() }}件</p>
              <p>表示中：{{ ($notes->currentPage() -1) * $notes->perPage() + 1 }}~{{$notes->currentPage() * $notes->perPage()}}件/{{ $notes->total() }}件</p>
            </div>
            <div class="searchMenu_item">
              <div class="searchMenu_sort">
                <a href="/notes?pref={{request()->query('pref')}}&keyword={{request()->query('keyword')}}&sort=new" class="js-set-link">新着順</a>
                <span class="itemSeparater"></span>
                <a href="/notes?pref={{request()->query('pref')}}&keyword={{request()->query('keyword')}}&sort=bookmarks" class="js-set-link">ブックマーク数順</a>
                <span class="itemSeparater"></span>
                <a href="/notes?pref={{request()->query('pref')}}&keyword={{request()->query('keyword')}}&sort=comments" class="js-set-link">コメント数順</a>
              </div>
              <div>
                表示件数：
                <select class="searchMenu_showNum js-change-num">
                  <option value="10" @if(!isset($_GET['num']) || $_GET['num'] === '10') selected @endif>10件</option>
                  <option value="20" @if(isset($_GET['num']) && $_GET['num'] === '20') selected @endif>20件</option>
                  <option value="30" @if(isset($_GET['num']) && $_GET['num'] === '30') selected @endif>30件</option>
                </select>
              </div>
            </div>
          </div>
          <div class="list--note">
            <ul class="list_body--note">
              @component('components.notes',
                ['notes' => $notes])
              @endcomponent
            </ul>
          </div>
          {{ $notes->links() }}
        </div>
      </div>
    </main>

@endsection

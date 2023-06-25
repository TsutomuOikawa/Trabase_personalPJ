@foreach($notes as $note)
<li class="panel--note" data-pref="{{ $note->pref_id }}">
  <p class="panel_pref">{{ $note->pref_name }}</p>
  <a href="{{ route('notes.article', ['note_id' => $note->id]) }}" class="js-get-links">
    <div class="panel_thumbnail">
      <img src="@if($note->thumbnail){{ asset($note->thumbnail) }} @else {{ Storage::disk('s3')->url('assets/noImage.png') }} @endif" alt="{{ $note->title }}">
    </div>
    <div class="panel_info">
      <h3 class="panel_title">{{ $note->title }}</h3>
      <div class="userInfo">
        @if($note->avatar)
          <img src="{{ asset($note->avatar)}}" class="userInfo_img" alt="{{ $note->name.'さんのプロフィール画像' }}">
        @else
          <i class="fa-solid fa-user fa-lg" style="padding-right:10px;"></i>
        @endif
        <p class="userInfo_name">@if($note->name){{ $note->name }} @else 匿名ユーザー @endif</p>
      </div>
      <div class="panel_subInfo">
        <p>{{ date('y/m/d', strtotime($note->created_at)) }}投稿</p>
        <div class="iconBox">
          @auth
          <i class="fa-bookmark fa-lg @if($note->isFavorite) fa-solid js-active @else fa-regular @endif js-favorite"></i>
          @endauth
          @guest
          <i class="fa-bookmark fa-lg fa-regular js-favorite"></i>
          @endguest
          <span class="iconBox_num">@if($note->favNum) {{ $note->favNum }} @else 0 @endif</span>
          <i class="fa-regular fa-comment-dots fa-lg icon--comment"></i>
          <span class="iconBox_num">@if($note->comNum) {{ $note->comNum }} @else 0 @endif</span>
        </div>
      </div>
    </div>
  </a>
</li>
@endforeach

@empty($notes[0])
<p>まだ投稿がありません</p>
@endempty

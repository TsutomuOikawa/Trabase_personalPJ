<div class="splide">
  <div class="splide__track">
    <ul class="splide__list">

      @if($_SERVER['REQUEST_URI'] === '/mypage')
        @foreach($notes as $note)
          @if($note->thumbnail)
            <li class="splide__slide"><img src="{{ asset($note->thumbnail) }}" class="splide_img" alt="{{ $note->title }}"></li>
          @endif
        @endforeach

      @elseif(strpos($_SERVER['REQUEST_URI'], 'pref/'))
        <li class="splide__slide"><img src="{{ Storage::disk('s3')->url('assets/hero/'.$data->pref_name.'.jpg') }}" class="splide_img" alt="{{ $data->pref_name }}のイメージ写真"></li>
        @foreach($notes as $note)
          @if($note->thumbnail)
            <li class="splide__slide"><img src="{{ asset($note->thumbnail) }}" class="splide_img" alt="{{ $note->title }}"></li>
          @endif
        @endforeach

      @else
        @foreach($prefs as $pref)
          <li class="splide__slide"><img src="{{ Storage::disk('s3')->url('assets/hero/'.$pref->name.'.jpg') }}" class="splide_img" alt="{{ $pref->name }}のイメージ写真"></li>
        @endforeach
      @endif
    </ul>
  </div>
</div>

<div class="list--destination">
  <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-minus"></i>北海道・東北</{{ $tag }}>
  <div class="list_body--destination js-toggle-list js-active">
  @foreach($prefectures as $prefecture)
    <a href="{{ route('pref', ['pref_id' => $prefecture->pref_id]) }}" class="panel--destination js-change-back">
      <img src="{{ Storage::disk('s3')->url('assets/hero/'.$pref->pref_name.'.jpg') }}" class="panel_destImg" alt="{{ $prefecture->pref_name }}のイメージ写真">
      <span class="panel_destCover">
        <span class="panel_destName">{{ $prefecture->pref_name }}</span>
      </span>
    </a>

  @switch($prefecture->pref_id)
    @case(7)
  </div>
  <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-plus"></i>関東</{{ $tag }}>
  <div class="list_body--destination js-toggle-list">
    @break

    @case(14)
  </div>
  <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-plus"></i>北陸・甲信越</{{ $tag }}>
  <div class="list_body--destination js-toggle-list">
    @break

    @case(20)
  </div>
  <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-plus"></i>東海</{{ $tag }}>
  <div class="list_body--destination js-toggle-list">
    @break

    @case(24)
  </div>
  <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-plus"></i>近畿</{{ $tag }}>
  <div class="list_body--destination js-toggle-list">
    @break

    @case(30)
  </div>
  <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-plus"></i>中国・四国</{{ $tag }}>
  <div class="list_body--destination js-toggle-list">
    @break

    @case(39)
    </div>
    <{{ $tag }} class="list_title js-switch-toggle-list"><i class="fa-solid fa-square-plus"></i>九州・沖縄</{{ $tag }}>
    <div class="list_body--destination js-toggle-list">

    @default
  @endswitch
  @endforeach
  </div>
</div>
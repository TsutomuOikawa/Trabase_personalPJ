@php
// トータルページが3以上の場合
if ($paginator->lastPage() >= 3) {
  // 1P〜表示数の半分までのPでは、一番左が1からlistItemNum数のアイテムを表示で固定。
  if ($paginator->currentPage() <= ceil(3 /2)) {
    $maxPageNum = 3;
    $minPageNum = 1;
  // アイテムが変動するエリア。3が偶数の場合は、12(3)456のように表示。
  }elseif (ceil(3 /2) < $paginator->currentPage() && $paginator->currentPage() < ($paginator->lastPage() - floor(3 /2))) {
    $maxPageNum = $paginator->currentPage() + floor(3 /2);
    $minPageNum = $maxPageNum - 3 + 1;
  // 表示数の終わりの半分以降~最終Pまでは、一番右を最終ページで固定
  }elseif ($paginator->currentPage() >= floor(3 /2)) {
    $maxPageNum = $paginator->lastPage();
    $minPageNum = $maxPageNum - 3 + 1;
  }
// トータルページが3未満の場合表示される数字は変動しない
}else {
  $maxPageNum = $paginator->lastPage();
  $minPageNum = 1;
}
@endphp

<div class="pagination">
  <ul class="pagination_list">
  @if($paginator->currentPage() !== 1)
    <li class="pagination_item"><a href="{{ $paginator->url(1) }}"><i class="fa-solid fa-backward"></i></a></li>
  @endif
  @for($i = $minPageNum; $i <= $maxPageNum ; $i++)
    <li class="pagination_item @if($paginator->currentPage() === $i) active @endif"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
  @endfor
  @if($paginator->currentPage() !== $paginator->lastPage())
    <li class="pagination_item"><a href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fa-solid fa-forward"></i></a></li>
  @endif
  </ul>
</div>

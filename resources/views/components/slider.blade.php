<div class="splide">
  <div class="splide__track">
    <ul class="splide__list">
      @foreach($notes as $note)
      <li class="splide__slide"><img src="{{ asset($note->thumbnail) }}" class="splide_img" alt=""></li>
      @endforeach
    </ul>
  </div>
</div>

<ul class="list_body--wish">
  @foreach($wishes as $wish)
  <li class="panel--wish">
    @if($mine)
    @else
      <div class="userInfo">
        @if($wish->avatar)
          <img src="{{ asset($wish->avatar)}}" class="userInfo_img" alt="{{ $wish->name.'さんのプロフィール画像' }}">
        @else
          <i class="fa-solid fa-user fa-lg" style="padding-right:10px;"></i>
        @endif
        <p class="userInfo_name">@if($wish->name){{ $wish->name }} @else 匿名ユーザー @endif</p>
      </div>
    @endif
    <table class="panel_table">
      <tr class="panel_tableElm">
        <th>WHERE</th>
        <td class="js-get-spot">{{ $wish->spot }}</td>
      </tr>
      <tr class="panel_tableElm">
        <th>WHAT</th>
        <td class="js-get-thing">{{ $wish->thing }}</td>
      </tr>
    </table>
    @if($mine)
      <div class="iconBox">
        <i class="fa-regular fa-circle-check js-check-wish" style="margin-right: 30px; display:none;"></i>
        <form class="" action="{{ route('wish.delete', ['wish_id'=> $wish->id]) }}" method="post">
          @csrf @method('DELETE')
          <button type="submit" class="js-delete-wish"><i class="fa-solid fa-trash-can"></i></button>
        </form>
      </div>
    @else
      <i class="fa-solid fa-lightbulb js-show-modal js-get-wish"></i>
    @endif
  </li>
  @endforeach
  @empty($wishes[0])
  <p>現在登録されているウィッシュリストはありません</p>
  @endempty
</ul>

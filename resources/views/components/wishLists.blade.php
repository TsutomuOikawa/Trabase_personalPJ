<ul class="list_body--wish">
  @foreach($wishes as $wish)
  <li class="panel--wish">
    <div class="userInfo">
      @if($wish->user->avatar)
        <img src="{{ asset($wish->user->avatar)}}" class="userInfo_img" alt="{{ $wish->user->name.'さんのプロフィール画像' }}">
      @else
        <i class="fa-solid fa-user fa-lg" style="padding-right:10px;"></i>
      @endif
      <p class="userInfo_name">@if($note->name){{ $note->name }} @else 匿名ユーザー @endif</p>
      <p class="userInfo_name">@if($wish->user->name){{ $wish->user->name }} @else 匿名ユーザー @endif</p>
    </div>
    <table class="panel_table">
      <tr class="panel_tableElm">
        <th>WHERE</th>
        <td>{{ $wish->spot }}</td>
      </tr>
      <tr class="panel_tableElm">
        <th>WHAT</th>
        <td>{{ $wish->thing }}</td>
      </tr>
    </table>
    <i class="fa-sharp fa-solid fa-lightbulb"></i>
  </li>
  @endforeach
  
  @empty($wishes[0])
  <p>現在登録されているウィッシュリストはありません</p>
  @endempty
</ul>

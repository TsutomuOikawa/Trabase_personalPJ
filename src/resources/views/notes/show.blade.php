@extends('layouts.app')
@section('title', $note->title)
@section('content')
    <main class="page-wrapper">
		<div class="container--baseColor">
			<div class="container_body--l container_body--col">
				<aside class="sidebar--icon">
				@auth
					<div class="sidebar_wrapper">
						<i class="fa-bookmark @if($note->isFavorite) fa-solid js-active @else fa-regular @endif js-favorite" data-note_id="{{ $note->id }}"></i>
					</div>
					@if($note->user_id === Auth::id())
					<div class="sidebar_wrapper">
						<a href="{{ route('notes.edit', ['note_id'=>$note->id]) }}">
							<i class="fa-solid fa-pen-to-square"></i>
						</a>
					</div>
					<div class="sidebar_wrapper">
						<i class="fa-solid fa-trash-can js-show-modal"></i>
					</div>
					@endif
				@endauth
				</aside>
				@if($note->user_id === Auth::id())
					@component('components.modal')
						@slot('modal_title')
							本当に削除しますか？
						@endslot
						@slot('modal_content')
							<form action="{{ route('notes.delete', ['note_id'=>$note->id]) }}" method="post" class="form">
								@csrf
								@method('DELETE')
								<button type="submit" class="form_button" name="">削除する</button>
							</form>
						@endslot
						@slot('modal_action')
							&gt キャンセルする
						@endslot
					@endcomponent
				@endif

				<article class="note">
					<section class="note_contents js-set-padding">
						<img src="{{ $note->thumbnail }}" alt="" class="note_thumbnail js-get-height">
						<h1 class="note_title">{{ $note->title }}</h1>
						<div class="note_text">
						@foreach($note->content['blocks'] as $block)
							@if($block['type'] === 'header')
								<h{{ $block['data']['level'] }} id="{{ $block['data']['text'] }}" class="note_h{{ $block['data']['level'] }}">{{ $block['data']['text'] }}</h{{ $block['data']['level'] }}>
							@elseif($block['type'] === 'paragraph')
								<p class="note_paragraph">{!! $block['data']['text'] !!}</p>
							@elseif($block['type'] === 'list')

							@if($block['data']['style'] === 'ordered')
								<ul class="note_list" style="list-style: decimal inside;">
							@elseif($block['data']['style'] === 'unordered')
								<ul class="note_list" style="list-style: disc inside;">
							@endif
								@foreach($block['data']['items'] as $item)
									<li>{{ $item }}</li>
								@endforeach
								</ul>
							@endif
						@endforeach
						</div>
					</section>

					<section class="comments">
						<p class="comments_title">コメント</p>
						<ul class="comments_list">
						@foreach($note->comments as $comment)
							<li class="comments_item">
								<div class="userInfo">
								@if($comment->user->avatar)
									<img src="{{ asset($comment->user->avatar)}}" class="userInfo_img" alt="{{ $comment->user->name.'さんのプロフィール画像' }}">
								@else
									<i class="fa-solid fa-user fa-lg" style="padding-right:10px;"></i>
								@endif
									<p class="userInfo_name">@if($comment->user->name){{ $comment->user->name }} @else 匿名ユーザー @endif</p>
									<p class="userInfo_date">{{ date('y/m/d', strtotime($comment->created_at)); }}投稿</p>
								</div>
								<p class="comments_text">{{ $comment->content }}</p>
							</li>
						@endforeach
						</ul>
						@auth
							<form action="{{ route('comment.storeComment', ['note_id' => $note->id]) }}" method="post">
							@csrf @method('POST')
								<textarea name="comment" class="comments_posting" rows="2" placeholder="感想・参考になったことなどをコメントしてみよう"></textarea>
								<button type="submit" class="form_button">送信する</button>
							</form>
						@endauth
						@guest
							<p>コメントするにはログインが必要です</p>
							<a href="{{ route('login') }}">&gt; ログインする</a>
						@endguest
					</section>
				</article>

				@if($note->user_id !== Auth::id())
				<div class="followingBtn js-show-modal">
					<i class="fa-solid fa-up-right-from-square"></i>
					<p>イキタイ！</p>
				</div>
				@component('components.modal')
					@slot('modal_title')
						@auth マイリスト登録 @endauth
						@guest マイリスト登録はログイン後にご利用いただけます @endguest
					@endslot
					@slot('modal_content')
						@auth
						<form class="modal_form form" action="{{ route('wish.storeWish') }}" method="post">
						@csrf
							<label>
								<div class="form_name">
									<span class="form_label form_label--required">必須</span>
									都道府県
								</div>
								<select name="prefecture_id" class="form_input @error('prefecture_id') form_input--err @enderror js-get-note-pref" >
								@foreach($prefectures as $prefecture)
									<option value="{{ $prefecture['id'] }}" @if(old('prefecture_id') === $prefecture['id']) selected @elseif($note->prefecture_id === $prefecture['id']) selected @endif>{{ $prefecture['name'] }}</option>
								@endforeach
								</select>
							</label>
							<p class="form_errMsg"></p>
							<label>
								<div class="form_name">
									<span class="form_label form_label--required">必須</span>
									どこで
								</div>
								<input type="text" name="spot" class="form_input" value="{{ old('spot') }}" placeholder="富士山の山頂">
							</label>
							<p class="form_errMsg"></p>
							<label>
								<div class="form_name">
									<span class="form_label form_label--optional">任意</span>
									何をしたい？
								</div>
								<input type="text" name="thing" class="form_input" value="{{ old('thing') }}" placeholder="ご来光をみたい">
							</label>
							<p class="form_errMsg"></p>
							<button type="submit" class="form_button" name="button">登録する</button>
						</form>
						@endauth
						@guest
							<a href="{{ route('login') }}" class="modal_header">&gt ログインはこちら</a>
						@endguest
					@endslot
					@slot('modal_action')
					&gt 閉じる
					@endslot
				@endcomponent
				@endif

				<aside class="sidebar">
					<div class="sidebar_wrapper">
						<div class="sidebar_profile">
							<div class="userInfo userInfo--big">
							@if($note->avatar)
								<img src="{{ asset($note->avatar)}}" class="userInfo_img userInfo_img--big" alt="{{ $note->name.'さんのプロフィール画像' }}">
							@endif
								<p class="userInfo_name userInfo_name--big">@if($note->name){{ $note->name }} @else 匿名ユーザー @endif</p>
								<p class="userInfo_intro">{{ $note->introduction }}</p>
							</div>
						</div>
						<div class="sidebar_summary">
							<p class="sidebar_title">{{ $note->title }}</p>
							<p class="sidebar_date">{{ date('y/m/d', strtotime($note->created_at)); }} 投稿</p>
							<ul class="sidebar_chapters">
							@foreach($note->content['blocks'] as $block)
								@if($block['type'] === 'header')
								<li><a href="#{{ $block['data']['text'] }}">{{ $block['data']['text'] }}</a></li>
								@endif
							@endforeach
							</ul>
						</div>
					</div>
				</aside>
			</div>
		</div>
    </main>
@endsection

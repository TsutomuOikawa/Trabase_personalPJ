@extends('layouts.app')
@section( 'title', 'ノート投稿｜Trabase（トラベス）')
@section('content')
<div class="flashMsg flashMsg--err js-show-flashMsg">
	<p class="flashMsg_text js-get-flashMsg"></p>
</div>
    <main class="page-wrapper">
      <div class="container--baseColor">
        <div class="container_body--s">
          <form name="editor" class="form--editor js-get-note" method="post" action="{{ route('notes.store') }}" enctype="multipart/form-data">
            @csrf
            <label>
				<div class="form_name">
					<span class="form_label form_label--required">必須</span>
					タイトル
				</div>
				@if($editMode)
					<input type="text" name="title" class="form_input form_input--header @error('title') form_input--err @enderror js-get-note-title" value="{{ (old('title'))?old('title'):$note->title }}">
				@else
					<input type="text" name="title" class="form_input form_input--header @error('title') form_input--err @enderror js-get-note-title" value="{{ old('title') }}">
				@endif
            </label>
            <p class="form_errMsg">@error('title') {{ $message }} @enderror</p>

            @if($editMode)
            <img src="{{ asset($note->thumbnail) }}" alt="">
            <div class="form_addThumbnail js-add-thumbnail">
				<i class="fa-solid fa-trash-can fa-lg"></i>
				サムネイル画像を変更する
            </div>

            @else
            <div class="form_addThumbnail js-add-thumbnail">
				<i class="fa-regular fa-image fa-2x"></i>
				サムネイル画像を設定する
            </div>
            @endif
            <label class="js-input-thumbnail" style="display:none;">
				<div class="form_name">
					<span class="form_label form_label--optional">任意</span>
					サムネイル画像
				</div>
				<input type="file" name="thumbnail" class="form_thumbnail" value="{{ old('thumbnail') }}">
            </label>
            <p class="form_errMsg">@error('thumbnail') {{ $message }} @enderror</p>

            <label>
				<div class="form_name">
					<span class="form_label form_label--required">必須</span>
					旅先
				</div>
				<select name="pref_id" class="form_input form_input--half @error('id') form_input--err @enderror js-get-note-pref" >
					@foreach($prefectures as $prefecture)
						@if($editMode)
							<option value="{{ $prefecture['id'] }}" @if(old('pref_id') === $prefecture['id']) selected @elseif($note->id === $prefecture['id']) selected @endif>{{ $prefecture['name'] }}</option>
						@else
							<option value="{{ $prefecture['id'] }}" {{ (old('pref_id') === $prefecture['id']) ? 'selected' : '' }} >{{ $prefecture['name'] }}</option>
						@endif
					@endforeach
				</select>
            </label>
            <p class="form_errMsg">@error('pref_id') {{ $message }} @enderror</p>

            <label>
				<div class="form_name">
					<span class="form_label form_label--required">必須</span>
					本文
				</div>
				<div id="editor" class="form_editor"></div>
            </label>
            <p class="form_errMsg">@error('text') {{ $message }} @enderror</p>
            <button type="button" class="form_button js-save-note">@if($editMode) 更新する @else 投稿する @endif</button>
          </form>
        </div>
      </div>
    </main>

@endsection
@section('script')
	@vite('resources/js/app.js')
@endsection

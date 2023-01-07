@extends('layouts.app')
@section( 'title', 'ノート投稿｜Trabase（トラベス）')
@section('content')

    <main class="page-wrapper">
      <div class="container--note">
        <div class="container_body--s">
          <form class="note" method="post" action="{{ route('notes.store') }}" enctype="multipart/form-data">
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

            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                旅先
              </div>
              <select name="pref_id" class="form_input form_input--half @error('pref_id') form_input--err @enderror js-get-note-pref" >
              @foreach($prefs as $pref)
                @if($editMode)
                <option value="{{ $pref->pref_id }}" @if(old('pref_id')===$pref->pref_id) selected @elseif($note->pref_id === $pref->pref_id) selected @endif>{{ $pref->pref_name }}</option>
                @else
                <option value="{{ $pref->pref_id }}" {{ (old('pref_id')===$pref->pref_id)?'selected':'' }} >{{ $pref->pref_name }}</option>
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
    @vite(['resources/js/jquery-3.6.0.min.js','resources/js/editor.js'])

@endsection

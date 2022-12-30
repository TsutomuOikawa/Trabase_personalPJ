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
              <input type="text" name="title" class="form_input form_input--header @error('title') form_input--err @enderror js-get-note-title" value="">
            </label>
            <p class="form_errMsg">@error('title') {{ $message }} @enderror</p>

            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                旅先
              </div>
              <select name="pref_id" class="form_input form_input--half @error('pref_id') form_input--err @enderror" value="">
                @foreach($prefs as $pref)
                <option value="{{ $pref->pref_id }}" class="js-get-note-pref">{{ $pref->pref_name }}</option>
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

            <button type="button" class="form_button js-save-note" name="">投稿する</button>

          </form>
        </div>

      </div>
    </main>
    @vite(['resources/js/jquery-3.6.0.min.js','resources/js/editor.js'])

@endsection

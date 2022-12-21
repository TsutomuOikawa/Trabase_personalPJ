<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="alert--err js-show-err-msg">
      <p><?php //echo $err_msg['common']; ?></p>
    </div>

    <main class="page-wrapper">
      <div class="container--note">
        <div class="container_body">
          <form class="form" method="post" action="{{ route('notes.create') }}" enctype="multipart/form-data">
            @csrf
            <h2 class="form_title">旅の概要</h2>
            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                タイトル
              </div>
              <input type="text" name="title" class="form_input" value="">
            </label>
            @error('title')
            <p class="form_errMsg">{{ $message }}</p>
            @enderror

            <label>
              <div class="form_name">
                <span class="form_label form_label--optional">任意</span>
                タイトル画像
              </div>
              <input type="file" name="img" value="">
            </label>
            @error('img')
            <p class="form_errMsg">{{ $message }}</p>
            @enderror


            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                旅先
              </div>
              <select name="pref_id" class="form_input" value="">
                <option value="1">北海道</option>
              </select>
            </label>
            @error('pref_id')
            <p class="form_errMsg">{{ $message }}</p>
            @enderror

            <label>
              <div class="form_name">
                <span class="form_label form_label--required">必須</span>
                本文
              </div>
              <textarea name="text" class="form_input"></textarea>
            </label>
            @error('text')
            <p class="form_errMsg">{{ $message }}</p>
            @enderror

            <button type="submit" class="form_button" name="">投稿する</button>

          </form>
        </div>

      </div>
    </main>
  </body>
</html>

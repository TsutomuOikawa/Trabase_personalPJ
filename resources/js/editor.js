import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Paragraph from '@editorjs/paragraph';


$(function(){

  const createRegex = new RegExp('notes/new');
  const updateRegex = new RegExp('notes/[1-9]+[0-9]*/edit');
  let path = location.pathname;

  ////////////////////
  // エディターJSを初期化する関数
  function initEditor(data) {
    let editor = new EditorJS ({
      holderId: 'editor',
      data: data,
      tools: {
          header: {
            class: Header,
            config: {
              levels: [2, 3, 4],
              defaultLevel: 2
            }
          },
          image: {
            class: ImageTool,
            config: {
              readOnly: true,
              uploader: {
                //Fileを選択、ドラッグアンドドロップしたときに呼び出されるアップローダー
                // uploadByFile(file) {
                //   let formData = new FormData();
                //   formData.append("image", file);
                //   return axios
                //     .post("/api/uploadfile", formData, {
                //       headers: { "content-type": "multipart/form-data" },
                //     })
                //     .then((res) => {
                //       return res.data;
                //     });
                // },
                uploadByFile(file) {

                }
              }
            }
          },
          list: {
            class: List,
            inlineToolBar: true,
            config: {
              defaultStyle: 'unorderd'
            }
          },
          paragraph: {
            class: Paragraph,
            inlineToolBar: true,
            config: {
              preserveBlank: true
            }
          }
      },
      placeholder: '＋を押してスタート！'
    });

    // editorを関数外でも使えるようreturn
    return editor;
  }

  ////////////////////
  // AjaxでDB保存する関数
  function saveNote(editor, method) {
    let title = $('.js-get-note-title').val();
    let pref = $('.js-get-note-pref').val();
    let text = '';
    let redirectURL = '';

    editor.save()
      .then((outputData) => {
          text = JSON.stringify(outputData);
          console.log('textの中身');
          console.log(text);

          // 通信用データ
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: method,
            url: path,
            data: {pref_id: pref, title: title, text: text}
          })
          .done(function(redirect) {
            redirectURL = '/notes/'+ redirect;
            window.location = redirectURL;
          })
          .fail(function() {
             console.log('失敗');
          });
      })
      .catch((error) => {
        console.log('Saving failed: ', error);
      });
  }


  ////////////////////
  // ここから処理を開始

  ////////////////////
  // 新規投稿
  if (createRegex.test(path)) {
    // エディターを初期化
    let editor = initEditor({});

    // ノートの新規登録
    $('.js-save-note').on('click', function() {
      saveNote(editor, 'POST');
    });

  ////////////////////
  // 保存済み投稿の表示・更新
}else if (updateRegex.test(path)) {

    // 保存済み投稿を取得
    let note_id = path.replace('/notes/', '').replace('/edit', '');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: path,
      data: { note_id: note_id },
      dataType: 'json'
    })
    .done(function(savedData){
      // 保存したデータを渡してエディタを初期化
      let editor = initEditor(savedData);

      // ノートの更新処理をセット
      $('.js-save-note').on('click', function() {
        console.log('更新処理を開始');
        console.log(editor);
        saveNote(editor, 'PUT');
      });

    }).fail(function() {
      console.log('失敗');
    });
  }

// 最終閉じ
});

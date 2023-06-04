import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Paragraph from '@editorjs/paragraph';

const createRegex = new RegExp('^/notes/new/?$');
const updateRegex = new RegExp('^/notes/article/[1-9]+[0-9]*/edit/?$');
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
        // image: {
        //   class: ImageTool,
        //   config: {
        //     readOnly: true,
        //     uploader: {
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
        //       uploadByFile(file) {
        //
        //       }
        //     }
        //   }
        // },
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
function saveNote(editor, putFlag = false) {
  let formData = new FormData($('.js-get-note').get(0));
  let text = '';
  let redirectURL = '';

  editor.save()
    .then((outputData) => {
        text = JSON.stringify(outputData);
        formData.append('text', text);
        if (putFlag) {
          formData.append('_method', 'PUT');
        }
        console.log(...formData);

        // 通信用データ
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method: 'POST',
          url: path,
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false
        })
        .done(function(redirect) {
          redirectURL = '/notes/article/'+ redirect;
          window.location = redirectURL;
        })
        .fail(function(err) {
          console.log(err.responseJSON.message);
          // エラーメッセージ表示
          let msg = $('.js-show-flashMsg');
          $('.js-get-flashMsg').text(err.responseJSON.message);
          msg.addClass('js-active');
          setTimeout(function() {
            msg.removeClass('js-active');
          }, 4000);
        });
    })
    .catch((error) => {
      console.log('Saving failed: ', error);
    });
}


// エクスポート用の関数
function setEditor() {
  ////////////////////
  // 新規投稿
  if (createRegex.test(path)) {
    // エディターを初期化
    let editor = initEditor({});

    // ノートの新規登録
    $('.js-save-note').on('click', function() {
      saveNote(editor);
    });

  ////////////////////
  // 保存済み投稿の表示・更新
}else if (updateRegex.test(path)) {

    // 保存済み投稿を取得
    let note_id = path.replace('/notes/article/', '').replace('/edit', '');
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
        saveNote(editor, true);
      });

    }).fail(function() {
    });
  }

}

export {setEditor};

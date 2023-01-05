import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Paragraph from '@editorjs/paragraph';

const regex = new RegExp('notes/[1-9]+[0-9]*/edit');
let path = location.pathname;
let note_id = path.replace('/notes/', '').replace('/edit', '');

$(function(){
  if (regex.test(path)) {

    // 編集モードなのでテキストデータを取得
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'POST',
      url: path,
      data: { note_id: note_id },
      dataType: 'json'
    })
    .done(function(data){
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

    }).fail(function() {
      console.log('失敗');
    });


  }else {
    // 初回投稿モード
    let editor = new EditorJS ({
      holderId: 'editor',
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
      placeholder: '＋を押してスタート！',
    });

  }


  // データ保存
  $('.js-save-note').on('click', function() {
    let title = $('.js-get-note-title').val();
    let pref = $('.js-get-note-pref').val();
    let text = '';

    editor.save()
      .then((outputData) => {
          text = JSON.stringify(outputData);

          // 通信用データ
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '/notes/new',
            data: {pref_id: pref, title: title, text: text}
          })
          .done(function() {
            console.log('成功');
            window.location = ('/mypage');
          })
          .fail(function() {
             console.log('失敗');
          });
      })
      .catch((error) => {console.log('Saving failed: ', error)});
  });

});

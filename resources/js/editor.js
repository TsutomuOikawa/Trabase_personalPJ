import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Table from '@editorjs/table';
import Paragraph from '@editorjs/paragraph';

const editor = new EditorJS ({
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
      table: {
        class: Table,
        inlineToolBar: true,
        config: {
          rows: 2,
          cols: 3
        }
      },
      paragraph: {
        class: Paragraph,
        inlineToolBar: true,
        config: {
          preserveBlank: true
        }
      }
  }
});

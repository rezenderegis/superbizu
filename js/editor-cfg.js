/**
* Autor: Thiago Luís <thiagoluismo@gmail.com>
* Controle do editor de texto QuillJs (https://quilljs.com/).
* Créditos: TaylorPzreal (https://github.com/quilljs/quill/issues/1089#issuecomment-319567957)
*/
var editor = (function() {

    var actionUpload = 'questoes/upload';

    var cfg = {
        modules: {
            formula: true,
            toolbar: [

                ['bold', 'italic', 'underline', 'strike'],

                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],

                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],

                ['formula', 'image'],

                ['clean']
            ],
        },
        theme: 'snow'
    };

    function selectLocalImage() {
        var quill = this.quill;
        var input = $('<input type="file">');
        input.click();

        input.change(function() {
            var file = input[0].files[0];

            if (/^image\//.test(file.type)) {
                saveToServer(file, quill);
            } else {
                alert('Escolha uma imagem.');
            }
        });
    }

    function saveToServer(file, quill) {
        var fd = new FormData();
        var xhr = new XMLHttpRequest();
        var action = getBaseUrl() + actionUpload;

        fd.append('image', file);
        xhr.open('POST', action);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var url = JSON.parse(xhr.responseText).url;
                insertToEditor(url, quill);
            }
        };
        xhr.send(fd);
    }

    function insertToEditor(url, quill) {
        var range = quill.getSelection();
        quill.insertEmbed(range.index, 'image', url);
    }

    function getBaseUrl() {
        var baseUrl = '';
        var array = location.href.split('/');
        for(var i = 0; i < array.length; i++) {

            if (i == 0) {
                baseUrl += array[i] + '//';
            } else if (array[i] != '') {
                baseUrl += array[i] + '/';
            }

            if (array[i] == 'index.php') break;
        }

        return baseUrl;
    }

    return {
        cfg: cfg,
        selectLocalImage: selectLocalImage
    }
})();

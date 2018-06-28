/**
* Autor: Thiago Luís <thiagoluismo@gmail.com>
* Objetivo: Controlar o editor de texto QuillJs (https://quilljs.com/).
* Créditos: TaylorPzreal (https://github.com/quilljs/quill/issues/1089#issuecomment-319567957)
*/
var editor = (function() {

    /* Diferença entre arrays. https://stackoverflow.com/questions/1187518/how-to-get-the-difference-between-two-arrays-in-javascript#4026828 */
    Array.prototype.diff = function(a) {
        return this.filter(function(i) {return a.indexOf(i) < 0;});
    };

    /* Ações. */
    var actionUpload = 'questoes/upload';
    var actionDeleteFile = 'questoes/deleteFile';

    /* Configuração do QuillJs. */
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

    /* Seleção da imagem. */
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

    /* Upload. */
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

    /*
    *  Substitui o valor do atributo src para o caminho do arquivo.
    *  Cada imagem inserida é armazenada em data-server.
    */
    function insertToEditor(url, quill) {
        var $quill = $(quill);
        var range = quill.getSelection();
        var $content = $(quill.root.innerHTML);
        var server = $quill.data('server');
        var local = getUploads($content);

        server = server == undefined ? local : server;

        server.push(url);
        $quill.data('server', server);
        quill.insertEmbed(range.index, 'image', url);
    }

    /* Retorna o caminho base da url. */
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

    /* Retorna um array com o caminho de todos uploads realizados. */
    function getUploads(content) {
        var img = content.find('img');
        var paths = [];
        for (var i = 0; i < img.length; i++) {
            paths.push(img[i].src);
        }
        return paths;
    }

    /* Sincronização entre o server e client. */
    function filesSync(quill) {
        var action = getBaseUrl() + actionDeleteFile;
        var $quill = $(quill);
        var $content = $(quill.root.innerHTML);
        var server = $quill.data('server');
        var local = getUploads($content);

        server = server == undefined ? local : server;
        var diff = server.diff(local);

        for (var i = 0; i < diff.length; i++) {
            var index = server.indexOf(diff[i]);
            $.post(action, {file: diff[i]});

            if (index > -1) {
                server.splice(index, 1);
            }
        }
        $quill.data('server', server);
    }

    return {
        cfg: cfg,
        selectLocalImage: selectLocalImage,
        filesSync: filesSync
    }
})();

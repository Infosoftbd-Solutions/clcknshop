<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.css" />
<script>
    require.config({
        shim: {
            'codemirror/lib/codemirror': ['jquery'],
            'codemirror/mod/javascript/javascript':[],
            'codemirror/mod/php/php':[],
            'codemirror/mod/clike/clike':[],
            'codemirror/mod/htmlmixed/htmlmixed':[],
            'codemirror/mod/css/css':[],
            'codemirror/mod/xml/xml':[],
            'codemirror/mod/markdown/markdown':[],
            'codemirror/mod/meta':[]


        },
        paths: {
            'codemirror/mod/meta':'js/codemirror/mod/meta.min',
            'codemirror/mod/javascript/javascript': 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/javascript/javascript.min',
            'codemirror/mod/php/php': 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/php/php.min',
            'codemirror/mod/css/css': 'js/codemirror/mod/modules/css.min',
            'codemirror/mod/xml/xml': 'js/codemirror/mod/modules/xml.min',
            'codemirror/mod/markdown/markdown': 'js/codemirror/mod/modules/markdown.min',
            'codemirror/mod/htmlmixed/htmlmixed': 'js/codemirror/mod/modules/htmlmixed.min',
            'codemirror/mod/clike/clike': 'js/codemirror/mod/modules/clike.min',
            'codemirror/lib/codemirror': 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min',

        }
    });

</script>

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/php/php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/xml/xml.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/htmlmixed/htmlmixed.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/markdown/markdown.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/clike/clike.min.js"></script>
-->

<textarea id="editorarea">

</textarea>

<script>
require(['jquery','codemirror/lib/codemirror','codemirror/mod/meta','codemirror/mod/javascript/javascript','codemirror/mod/php/php','codemirror/mod/markdown/markdown','codemirror/mod/htmlmixed/htmlmixed','codemirror/mod/clike/clike','codemirror/mod/css/css','codemirror/mod/xml/xml'], function ($, CodeMirror) {
    $(document).ready(function() {

editor = CodeMirror.fromTextArea($("#editorarea")[0], {
      lineNumbers: true,
      mode: "application/x-httpd-php",
      indentUnit: 4,
      indentWithTabs: true,
      lineWrapping: true,
      gutters: ["CodeMirror-lint-markers"],
      lint: true
    });

  });
});


</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/style.min.css" />
<link rel="stylesheet" href="https://codemirror.net/5/addon/dialog/dialog.css">
<link rel="stylesheet" href="https://codemirror.net/5/addon/search/matchesonscrollbar.css">
<link rel="stylesheet" href="https://codemirror.net/5/addon/fold/foldgutter.css">
<script>
    require.config({
        shim: {
            'jstree': ['jquery', 'bootstrap', 'popper'],
        },
        paths: {
            'jstree': '//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/jstree.min',
            'popper': ['//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min', 'popper.min'],
        }
    });
</script>


<script>
    require.config({
        shim: {
            'codemirror/lib/codemirror': ['jquery'],
            'codemirror/mod/javascript/javascript': [],
            'codemirror/mod/php/php': [],
            'codemirror/mod/clike/clike': [],
            'codemirror/mod/htmlmixed/htmlmixed': [],
            'codemirror/mod/css/css': [],
            'codemirror/mod/xml/xml': [],
            'codemirror/mod/markdown/markdown': [],
            'codemirror/mod/meta': [],
            'codemirror/addon/dialog/dialog': [],
            'codemirror/addon/search/searchcursor': [],
            'codemirror/addon/search/search': [],
            'codemirror/addon/scroll/annotatescrollbar': [],
            'codemirror/addon/search/matchesonscrollbar': [],
            'codemirror/addon/fold/foldcode': [],
            'codemirror/addon/fold/foldgutter': [],
            'codemirror/addon/fold/brace-fold': [],
            'codemirror/addon/fold/xml-fold': [],
            'codemirror/addon/fold/indent-fold': [],
            'codemirror/addon/fold/markdown-fold': [],
            'codemirror/addon/fold/comment-fold': [],

        },
        paths: {
            'codemirror/mod/meta': 'js/codemirror/mod/meta.min',
            'codemirror/mod/javascript/javascript': 'js/codemirror/mod/modules/javascript.min',
            'codemirror/mod/php/php': 'js/codemirror/mod/modules/php.min',
            'codemirror/mod/css/css': 'js/codemirror/mod/modules/css.min',
            'codemirror/mod/xml/xml': 'js/codemirror/mod/modules/xml.min',
            'codemirror/mod/markdown/markdown': 'js/codemirror/mod/modules/markdown.min',
            'codemirror/mod/htmlmixed/htmlmixed': 'js/codemirror/mod/modules/htmlmixed.min',
            'codemirror/mod/clike/clike': 'js/codemirror/mod/modules/clike.min',
            'codemirror/addon/dialog/dialog': '//codemirror.net/5/addon/dialog/dialog',
            'codemirror/addon/search/searchcursor': '//codemirror.net/5/addon/search/searchcursor',
            'codemirror/addon/search/search': '//codemirror.net/5/addon/search/search',
            'codemirror/addon/scroll/annotatescrollbar': '//codemirror.net/5/addon/scroll/annotatescrollbar',
            'codemirror/addon/search/matchesonscrollbar': '//codemirror.net/5/addon/search/matchesonscrollbar',
            'codemirror/addon/fold/foldcode': '//codemirror.net/5/addon/fold/foldcode',
            'codemirror/addon/fold/foldgutter': '//codemirror.net/5/addon/fold/foldgutter',
            'codemirror/addon/fold/brace-fold': '//codemirror.net/5/addon/fold/brace-fold',
            'codemirror/addon/fold/xml-fold': '//codemirror.net/5/addon/fold/xml-fold',
            'codemirror/addon/fold/indent-fold': '//codemirror.net/5/addon/fold/indent-fold',
            'codemirror/addon/fold/markdown-fold': '//codemirror.net/5/addon/fold/markdown-fold',
            'codemirror/addon/fold/comment-fold': '//codemirror.net/5/addon/fold/comment-fold',
            'codemirror/lib/codemirror': 'js/codemirror/lib/codemirror.min',
        }
    });
</script>


<style type="text/css">
    .fileUpload {
        position: relative;
        overflow: hidden;
        /*margin: 10px;*/
    }

    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

<style type="text/css">
    h1,
    h1 a,
    h1 a:hover {
        margin: 0;
        padding: 0;
        color: #444;
        cursor: default;
        text-decoration: none;
    }

    #files {
        padding: 20px 10px;
        margin-bottom: 10px;
    }

    #files>div {
        overflow: auto;
    }

    #path {
        margin-left: 10px;
    }

  
</style>
<script type="text/javascript">
    var editor;
    require(['jquery', 'codemirror/lib/codemirror', 'codemirror/mod/meta', 'codemirror/mod/javascript/javascript',
        'codemirror/mod/php/php', 'codemirror/mod/markdown/markdown', 'codemirror/mod/htmlmixed/htmlmixed',
        'codemirror/mod/clike/clike', 'codemirror/mod/css/css', 'codemirror/mod/xml/xml',
        'codemirror/addon/dialog/dialog', 'codemirror/addon/search/searchcursor', 'codemirror/addon/search/search',
        'codemirror/addon/scroll/annotatescrollbar', 'codemirror/addon/search/matchesonscrollbar',
        'codemirror/addon/fold/foldcode', 'codemirror/addon/fold/foldgutter', 'codemirror/addon/fold/brace-fold',
        'codemirror/addon/fold/xml-fold', 'codemirror/addon/fold/indent-fold',
        'codemirror/addon/fold/markdown-fold','codemirror/addon/fold/comment-fold',
    ], function ($, CodeMirror) {
        $(document).ready(function () {

            editor = CodeMirror.fromTextArea($("#editor")[0], {
                lineNumbers: true,
                mode: "text/html",
                indentUnit: 4,
                indentWithTabs: true,
                // lineWrapping: true
                extraKeys: {
                    "Ctrl-Q": function (cm) {
                        cm.foldCode(cm.getCursor());
                    }
                },
                foldGutter: true,
                gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],

            });
            // console.log("this is a test");
            // editor.foldCode(CodeMirror.Pos(0, 0));
            editor.setSize("100%", "500px");

        });
    });
    require(['jquery', 'bootstrap', 'popper', 'jstree'], function ($, jstree) {
        $(document).ready(function (uri) {

            $("form").submit(function (e) {
                event.preventDefault();
            });

            $("input:file").change(function () {
                var fileName = $(this).val();
                //$(".filename").html(fileName);
                //alert(fileName);
                if (fileName != '') {
                    var ext = fileName.split('.').pop().toLowerCase();
                    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'css', 'js', 'ctp']) == -
                        1) {
                        alertBox("Invalid file format", "warning");
                        return false;
                    }

                    path = $("#path").html();
                    if (path.length == 0 || path.length < 0) {
                        alertBox("Please select a file or directory", "warning");
                        return false;
                    }

                    end = path.substring(path.length - 1)
                    if (end == "/") {
                        path = path;
                    } else {
                        path = path.substring(0, path.lastIndexOf("/") + 1);
                    }
                    $("#upload_path").val(encodeURIComponent(path));

                    $(this.form).submit();
                }
            });

            $.ajaxSetup({
                beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        'X-CSRF-Token',
                    <?= json_encode($this -> request -> param('_csrfToken')); ?>
                )
        }
        });


    function alertBox(message, className) {
        $(".alert").removeClass("alert-success alert-warning alert-danger");

        $(".alert").html(message).addClass("alert-" + className.trim()).fadeIn();

        setTimeout(function () {
            $(".alert").fadeOut();
        }, 5000);
    }

    function validate_filename(filename) {
        let pattern = /^[\w,\s-]+\.[A-Za-z]{3}$/gi;
        return pattern.test(filename);
    }


    function validate_direname(dirname) {
        let pattern = /^[\w,\s-]+[A-Za-z0-9]$/gi;
        return pattern.test(dirname);
    }

    function reloadFiles() {
        // $("#overlay").fadeIn(300);
        $.post("<?= $this->Url->build(['controller'=> 'themes', 'action' => 'action']) ?>", {
            action: "reload",
            path: "/"
        }, function (data) {

            $("#files > div").jstree("destroy");
            $("#files > div").html(data);
            $("#files > div").jstree();
            $("#files > div a:first").click();
            $("#path").html("");
            window.location.hash = "/";
            $("#overlay").fadeOut(100);
        });
    }

    // console.log('jstree',$("#files > div"));



    $("#files > div").jstree({
        state: {
            key: "pheditor"
        },
        plugins: ["state"]
    });

    $("#files").on("click", "a.open-file", function (event) {
        event.preventDefault();
        $("#overlay").fadeIn(300);
        var file = $(this).attr("data-file"),
            _this = $(this);

        window.location.hash = file;

        $.post("<?= $this->Url->build(['controller'=> 'themes', 'action' => 'action']) ?>", {
            action: "open",
            path: encodeURIComponent(file)

        }, function (data) {
            $("#overlay").fadeOut(300);
            // console.log(data.substring(0,8).trim());

            if (data.substring(0, 8).trim() == "success|") {
                alertBox(data.substring(8), "success");
                editor.setValue("");
            } else {
                editor.setValue(data);
            }
            // editor.val(data);


            $("#editor").attr("data-file", file);
            $("#path").html(file);
            $(".action-bar").find(".save, .delete, .rename, .reopen, .close")
                .removeClass("disabled");
        });
    });

    $("#files").on("click", "a.open-dir", function (event) {
        event.preventDefault();

        var dir = $(this).attr("data-dir"),
            _this = $(this);

        window.location.hash = dir;

        editor.setValue("");
        // editor.val("");
        $("#path").html(dir);
        $(".action-bar").find(".save, .reopen, .close").addClass("disabled");
        $(".action-bar").find(".delete, .rename").removeClass("disabled");
    });

    if (window.location.hash.length > 1) {
        var hash = window.location.hash.substring(1);

        setTimeout(function () {
            $("#files a[data-file=\"" + hash + "\"], #files a[data-dir=\"" + hash + "\"]")
                .click();
        }, 500);
    }

    // $('#editor_modal_file').on('hidden.bs.modal', function () {
    //    $("#editor_modal_file form").trigger("reset");
    //    $("#file_input").removeClass("is-valid");
    //    $("#file_input").removeClass("is-invalid");
    // });

    $(".action-bar .new-file").click(function () {
        var path = $("#path").html();

        if (path.length > 0) {
            $("#file_input").removeClass('is-invalid');
            $("#file_input").removeClass('is-valid');
            $("#editor_modal_file").modal();

            $("#file_input").keyup(function (e) {
                if (validate_filename($(this).val())) {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                } else {
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                }
            });

            $("#file_modal_submit").click(function (e) {
                let name = $("#file_input").val();

                if (name.length > 0 && validate_filename(name)) {
                    $("#editor_modal_file form").trigger("reset");
                    $("#editor_modal_file").modal('toggle');
                    path = $("#path").html();
                    end = path.substring(path.length - 1)

                    if (end == "/") {
                        path = path + name;
                    } else {
                        path = path.substring(0, path.lastIndexOf("/") + 1) + name;
                    }
                    $("#overlay").fadeIn(300);
                    $.post("<?= $this->Url->build(['controller' => 'themes', 'action' => 'action'])?>", {
                        action: "make-file",
                        path: encodeURIComponent(path),
                        data: ""
                    }, function (data) {
                        data = data.split("|");
                        if (data[0] == "success") {
                            reloadFiles();
                        } else {
                            $("#overlay").fadeOut(300);
                        }

                        alertBox(data[1], data[0]);
                        location.reload(true);
                    });

                } else {
                    $("#file_input").addClass("is-invalid");
                }

            });


        } else {
            alertBox("Please select a file or directory", "warning");
        }
    });

    $(".action-bar .new-dir").click(function () {
        var path = $("#path").html();
        if (path.length > 0) {
            $("#input_dir").removeClass('is-invalid');
            $("#input_dir").removeClass('is-valid');

            $("#editor_modal_dir").modal();

            $("#input_dir").keyup(function () {
                if (validate_direname($(this).val())) {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                } else {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            });

        } else {
            alertBox("Please select a file or directory", "warning");
        }
    });

    $("#dir_modal_submit").click(function () {
        let dir_name = $("#input_dir").val();

        if (dir_name.length > 0 && validate_direname(dir_name)) {
            $("#editor_modal_dir form").trigger("reset");
            $("#editor_modal_dir").modal('toggle');
            path = $("#path").html();
            end = path.substring(path.length - 1)

            if (end == "/") {
                path = path + dir_name;
            } else {
                path = path.substring(0, path.lastIndexOf("/") + 1) + dir_name;
            }
            $("#overlay").fadeIn(300);
            $.post("<?= $this->Url->build(['controller' => 'themes', 'action' => 'action'])?>", {
                action: "make-dir",
                path: encodeURIComponent(path)
            }, function (data) {
                // $("#overlay").fadeOut(300);
                data = data.split("|");
                if (data[0] == "success") {
                    reloadFiles();
                } else {
                    $("#overlay").fadeOut(300);
                }
                
                alertBox(data[1], data[0]);
                location.reload(true);
            });
        } else {
            $("#input_dir").removeClass('is-valid');
            $("#input_dir").addClass('is-invalid');
        }
    });




    $(".action-bar .save").click(function () {
        var path = $("#path").html(),
            data = editor.getValue();
        // data = editor.val();

        if (path.length > 0) {
            $("#overlay").fadeIn(300);
            $.post("<?= $this->Url->build(['controller' => 'themes', 'action' => 'action'])?>", {
                action: "save",
                path: path,
                data: data.trim()
            }, function (data) {
                $("#overlay").fadeOut(300);
                data = data.split("|");

                alertBox(data[1], data[0]);
            });
        } else {
            alertBox("Please select a file", "warning");
        }
    });


    $(".action-bar .close").click(function () {
        editor.setValue("");
        // editor.val("");
        $("#files > div a:first").click();
        $(".action-bar").find(".save, .delete, .rename, .reopen, .close").addClass(
            "disabled");
    });

    $(".action-bar .delete").click(function () {
        var path = $("#path").html();

        if (path.length > 0) {
            if (confirm("Are you sure to delete this file?")) {
                $("#overlay").fadeIn(300);
                $.post("<?= $this->Url->build(['controller' => 'themes', 'action' => 'action']) ?>", {
                    action: "delete",
                    path: path
                }, function (data) {
                    // $("#overlay").fadeOut(300);
                    data = data.split("|");

                    if (data[0] == "success") {
                        reloadFiles();
                    } else {
                        $("#overlay").fadeOut(300);
                    }
                    alertBox(data[1], data[0]);
                    location.reload(true);
                });
            }
        } else {
            alertBox("Please select a file or directory", "warning");
        }
    });

    $(".action-bar .rename").click(function () {
        var path = $("#path").html();

        if (path.length > 0) {
            $("#editor_modal_rename #input_rename").removeClass("is-valid");
            $("#editor_modal_rename #input_rename").removeClass("is-invalid");
            // var name = prompt("Please enter new name:", "new-name");
            var path_arr = path.split('/');
            var file = path_arr.pop();
            if (file.length > 0) {
                $("#editor_modal_rename #re_title").text("Rename File");
                $("#editor_modal_rename #input_rename_title").text("Enter your file name");
                $("#editor_modal_rename #input_rename").val(file);
                $("#editor_modal_rename").modal();
            } else {
                $("#editor_modal_rename #re_title").text("Rename Directory");
                $("#editor_modal_rename #input_rename_title").text(
                    "Enter your directory name");
                $("#editor_modal_rename #input_rename").val(path_arr.pop());
                $("#editor_modal_rename").modal();
            }
        } else {
            alertBox("Please select a file or directory", "warning");
        }
    });

    $("#input_rename").keyup(function (e) {
        path = $("#path").html();
        path_arr = path.split('/');
        file = path_arr.pop();
        if (file.length > 0) {
            if (validate_filename($(this).val())) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
                $("#editor_modal_rename #input_validate_feedback").text(
                    "Invalid file name!");
                $(this).addClass('is-invalid');
            }
        } else {
            if (validate_direname($(this).val())) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
                $("#editor_modal_rename #input_validate_feedback").text(
                    "Invalid file name!");
                $(this).addClass('is-invalid');
            }
        }

    });

    $("#rename_modal_submit").click(function () {
        path = $("#path").html();
        path_arr = path.split('/');
        file = path_arr.pop();
        let name = $("#editor_modal_rename #input_rename").val();
        var status = false;

        $("#editor_modal_rename form").trigger("reset");
        $("#editor_modal_rename").modal('toggle');

        if (file.length > 0) {
            if (name.length > 0 && validate_filename(name)) {
                status = true;
            } else {
                alertBox("Invalid File Name", "warning");
                status = false;
            }
        } else {
            // console.log("name "+name);
            // console.log(validate_direname(name));

            if (path.trim() != "/") {
                if (name.length > 0 && validate_direname(name)) {
                    status = true;
                } else {
                    console.log(path);
                    alertBox("Invalid Directory Name", "warning");
                    status = false;
                }
            } else {
                alertBox("Unable to rename main directory", "warning");
                status = false;
            }

        }

        // console.log("status : "+status);

        if (status == true) {
            $("#overlay").fadeIn(300);
            $.post("<?= $this->Url->build(['controller' => 'themes', 'action' => 'action']) ?>", {
                action: "rename",
                path: path,
                data: name
            }, function (data) {
                // $("#overlay").fadeOut(300);
                data = data.split("|");

                if (data[0] == "success") {
                    reloadFiles();
                } else {
                    $("#overlay").fadeOut(300);
                }
                alertBox(data[1], data[0]);
                location.reload(true);
            });
        }
    });


    // $("#form_input_file").change(function(e){
    //         path = $("#path").html();
    //         end = path.substring(path.length - 1);
    //
    //         if (end != "/") {
    //             path = path.substring(0, path.lastIndexOf("/") + 1);
    //         }
    //
    //         var name = e.files[0].name;
    //         console.log(name);
    //
    //         var form_data = new FormData();
    //         var ext = name.split('.').pop().toLowerCase();
    //         if(jQuery.inArray(ext, ['gif','png','jpg','jpeg', 'css','js','ctp']) == -1)
    //         {
    //             alertBox("Invalid file format", "success");
    //         }
    // });

    // $(".action-bar .upload").click(function () {
    //     var path = $("#path").html();
    //     if (path.length > 0) {
    //         $("#form_input_file").trigger("click");
    //     }
    // });

    $(window).resize(function () {
        if (window.innerWidth >= 720) {
            var height = window.innerHeight - $(".CodeMirror")[0].getBoundingClientRect()
                .top - 20;

            $("#files, .CodeMirror").css("height", height + "px");
        } else {
            $("#files > div, .CodeMirror").css("height", "");
        }
    });

    $(window).resize();

    $(".alert").click(function () {
        $(this).fadeOut();
    });

    $(document).bind("keyup keydown", function (event) {
        if ((event.ctrlKey || event.metaKey) && event.shiftKey) {
            if (event.keyCode == 78) {
                $(".action-bar .new-file").click();
                event.preventDefault();

                return false;
            } else if (event.keyCode == 83) {
                $(".action-bar .save").click();
                event.preventDefault();

                return false;
            }
        }
    });

    $(document).bind("keyup", function (event) {
        if (event.keyCode == 27) {
            if (document.activeElement.tagName.toLowerCase() == "textarea") {
                $(".jstree-clicked").focus();
            } else {
                editor.focus();
            }
        }
    });
    });
});
</script>

<style>
    .address-bar {
        display: block;
        background-color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        font-size: 16px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        /*overflow-x: scroll;*/
    }

    .address-bar #icon {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
</style>

<div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">

</div>
<div class="container-fluid">


    <div class="row p-3">
        <div class="col-lg-5 pb-3 pb-lg-0">
            <div class="address-bar">
                <span id="icon" class="btn btn-primary"><i class="fe fe-home"></i></span>
                <span id="path"></span>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="action-bar">
                <a class="save disabled btn btn-primary mb-2" href="javascript:void(0);"><i class="fe fe-save"></i>
                <?= __('Save') ?></a>
                <!--                <a class="upload btn btn-primary mb-2" href="javascript:void(0);"><i class="fe fe-upload-cloud"></i> Upload</a>-->
                <div class="fileUpload btn btn-primary mb-2">

                    <?= $this->Form->create(null,['type'=>'file', 'url' => ['controller' => 'themes', 'action'=> 'upload']]) ?>
                    <span><i class="fe fe-upload-cloud"></i> <?= __('Upload') ?></span>
                    <input type="file" class="upload" name="file" />
                    <?= $this->Form->hidden('path',['id'=>'upload_path']) ?>
                    <?= $this->Form->end() ?>

                </div>

                <a class="new-file btn btn-primary mb-2" href="javascript:void(0);"><i class="fe fe-plus"></i> <?= __('New
                    File') ?> </a>
                <a class="new-dir btn btn-primary mb-2" href="javascript:void(0);"><i class="fe fe-plus"></i> <?= __('New
                    Directory') ?> </a>
                <a class="rename disabled btn btn-primary mb-2" href="javascript:void(0);"><i class="fe fe-edit"></i>
                <?= __('Rename') ?></a>
                <a class="delete disabled btn btn-primary mb-2" href="javascript:void(0);"><i
                        class="fe fe-trash"></i><?= __('Delete') ?></a>
            </div>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div id="files" class="card">
                <div class="card-block">
                    <?= $data ?>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-block">
                    <textarea id="editor" data-file="" class="form-control"></textarea>
                </div>
            </div>
        </div>

    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="editor_modal_dir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Create New Directory') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="input_dir"> <?= __('Enter your directory name') ?></label>
                        <input type="text" class="form-control" id="input_dir">
                        <div class="invalid-feedback"><?= __('Invalid Directory Name !!') ?> </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="dir_modal_submit" class="btn btn-primary"> <?= __('submit') ?></button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editor_modal_rename" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="re_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <label id="input_rename_title"></label>
                        <input type="text" class="form-control" id="input_rename">
                        <div class="invalid-feedback" id="input_validate_feedback"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="rename_modal_submit" class="btn btn-primary"><?= __('submit') ?></button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editor_modal_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"><?= __('Create New File') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="file_input"><?= __('Enter your file name') ?></label>
                        <input type="text" class="form-control" id="file_input">
                        <div class="invalid-feedback"> <?= __('Invalid File Name') ?></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="file_modal_submit" class="btn btn-primary"><?= __('submit') ?></button>
            </div>
        </div>
    </div>
</div>
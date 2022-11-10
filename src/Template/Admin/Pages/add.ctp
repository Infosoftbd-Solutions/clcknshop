<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<script>
    require.config({
        shim: {
            'jqueryui': ['jquery','bootstrap']
        },
        paths: {
            'jqueryui': 'https://code.jquery.com/ui/1.12.1/jquery-ui.min',
        }
    });
</script>
<script src="https://cdn.tiny.cloud/1/gs5masr745m7jgz51thm7xye0rdkxabzyc7qwh5q3lx2d9sh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="row">
    <div class="col-lg-12">
        <?= $this->Form->create($page,['class'=>'card']) ?>
        <div class="card-header">
            <h4 class="card-title"><?php echo ucfirst($this->request->action);  ?> Page</h4>
        </div>
        <div class="card-body">
            <fieldset class="form-fieldset">
                <?= $this->TablerForm->control('name', ['required']); ?>
                <?= $this->TablerForm->control('slug', ['required']); ?>
                <?= $this->TablerForm->control('content'); ?>
            </fieldset>
        </div>
        <div class="card-footer text-right">
            <div class="d-flex">
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-link">Cancel</a>
                <button type="submit" id="page_submit_form" class="btn btn-primary ml-auto">Save Changes</button>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>


<script>
    require(['jquery'], function ($) {
        $(document).ready(function() {
            tinymce.init({
                selector: '#content',
                min_height: 450,
                plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template paste filemanager help',
                toolbar: "undo redo | formatselect | fontselect fontsizeselect | bold italic | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons image media link |table | preview fullscreen",
                // fullscreen_native: true,
                statusbar: false,
                menubar:false,
                table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                image_advtab: true ,
                external_filemanager_path:"/tinymce_filemanager_plugin/filemanager/",
                filemanager_title:"Filemanager" ,
                external_plugins: { "filemanager" : "/tinymce_filemanager_plugin/filemanager/plugin.min.js"},
            });


            $("#page_submit_form").click(function (e) {
                var content = tinymce.get("content").getContent();
                console.log(content)
                var text = content.replace(/(<([^>]+)>)/gi, "");
                console.log(text)
                if(text.length == 0) e.preventDefault();
            });


            $("#slug").after("<div id='page-url'>http://clcknshop.com/page/" +  $("#slug").val() +   "</div>");
            $("#name").keyup(function(){
                $("#slug").val(convertToSlug($(this).val()));
                $("#slug").change();
            });
            $("#slug").change(function(){
                $('#page-url').text("http://clcknshop.com/page/" +  $("#slug").val());
            });

            function convertToSlug(Text)
            {
                return Text
                    .toLowerCase()
                    .replace(/ /g,'-')
                    .replace(/[^\w-]+/g,'');
            }



        });
    });
</script>


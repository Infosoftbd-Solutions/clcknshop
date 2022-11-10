<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<script src="https://cdn.tiny.cloud/1/gs5masr745m7jgz51thm7xye0rdkxabzyc7qwh5q3lx2d9sh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="row">


    <div class="col-lg-12">

        <?= $this->Form->create($blog,['id'=>'blog_post_form','class'=>'card']) ?>
        <div class="card-header">
            <h4 class="card-title">Add New Post</h4>
            <div class="card-options">
                <button type="submit"  class="btn btn-primary ml-auto blog-post-submit-btn">Published Post</button>
            </div>
        </div>
        <div class="card-body">
            <fieldset class="form-fieldset">
                <div class="row">
                    <?php
                    echo $this->TablerForm->control('title', ['row' => 12, 'id' => 'post_title' ]);
                    echo $this->TablerForm->control('permalink', ['row' => 12, 'id' => 'permalink', 'prepend' => $this->Url->build('/blog/', true)]);
                    echo $this->TablerForm->control('body', ['row' => 12, 'id' =>'body']);
                    echo $this->TablerForm->control('labels', ['row' => 12, 'id' => 'labels' ]);
                    echo $this->TablerForm->control('published',['row' => 6, 'id' => 'published', 'options' => ['1' => 'Published', '0' => 'Draft']]);
                    echo $this->TablerForm->control('sort_by',['row' => 6, 'id' => 'sort_by', 'options' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25]]);
                    ?>
                </div>
            </fieldset>


        </div>
        <div class="card-footer text-right">
            <div class="d-flex">
                <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'index']) ?>" class="btn btn-link">Cancel</a>

                <button type="submit" class="btn btn-primary ml-auto blog-post-submit-btn">Published Post</button>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>

</div>



<script>
    require(['jquery', 'selectize'], function ($, selectize) {
        $(document).ready(function(){

            var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
            var validatedForm = true;
            var permalink = '<?= $blog->permalink ?>'.trim();

            $("#post_title, #permalink").focusout(function (e) {

                $.ajax({
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    url: '<?=$this->Url->build(['controller'=>'Blogs','action'=>'get_slug'])?>',
                    type: 'post',
                    dataType: 'json',
                    data: {title: $(this).val().trim()},
                    success: function(data) {

                        console.log(data);
                        if(data.hasOwnProperty("slug")){
                            $("#permalink").val(data.slug)

                            if (data.slug == permalink){
                                $("#permalink").removeClass('is-invalid');
                                validatedForm = true;
                                return;
                            }

                            if (data.unique == true){
                                $("#permalink").removeClass('is-invalid');
                                $("#permalink").addClass('is-valid');
                                validatedForm = true;
                            }
                            else{
                                $("#permalink").removeClass('is-valid');
                                $("#permalink").addClass('is-invalid');
                                validatedForm = false;
                            }

                        }
                    }
                });
            });

            $("#blog_post_form").submit(function (e) {
                if (validatedForm == false) e.preventDefault();
            });


            tinymce.init({
                selector: '#body',
                plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template paste filemanager fullscreen help',
                toolbar: "undo redo | formatselect | fontselect fontsizeselect | bold italic | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons image media link |table | preview fullscreen",
                fullscreen_native: true,
                relative_urls : false,
                remove_script_host : true,
                // toolbar_mode: 'floating',
                statusbar: false,
                menubar:false,
                table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                image_advtab: true ,
                external_filemanager_path:"/tinymce_filemanager_plugin/filemanager/",
                filemanager_title:"Filemanager" ,
                external_plugins: { "filemanager" : "/tinymce_filemanager_plugin/filemanager/plugin.min.js"},
            });



            $('#labels').selectize({
                delimiter: ',',
                persist: false,
                create: function (input) {
                    return {
                        value: input,
                        text: input
                    }
                }
            });

        });
    });

</script>


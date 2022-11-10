<?php echo $this->Html->css('/js/dropzone/dropzone.min.css'); ?>
 

<script>
  require.config({
    shim: {
        'dropzone': ['jquery', 'core']
    },
    paths: {
        'dropzone': '/js/dropzone/dropzone.min'
    }
});
</script>

<div class="page-header">
              <h1 class="page-title">
              <?= __('Product title/ Gallery') ?>
              </h1>
              <div class="page-subtitle"><?= __('10 photos') ?></div>
              <div class="page-options d-flex">
              <div class="custom-file">
                          <input type="file" class="custom-file-input" name="example-file-input-custom">

                </div>
              <div class="input-icon ml-2">

                 <input type="button" class="btn btn-primary" value="Add youtube video" />
                </div>
              </div>
            </div>



<form action="/file-upload" class="dropzone needsclick dz-clickable">
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>



<div class="row row-cards">
              <div class="col-sm-6 col-lg-4">
                <div class="card p-3">
                  <a href="javascript:void(0)" class="mb-3">
                    <img src="https://preview.tabler.io/demo/photos/grant-ritchie-338179-500.jpg" alt="Photo by Nathan Guerrero" class="rounded">
                  </a>
                  <div class="d-flex align-items-center px-2">

                    <div>
                      <div contenteditable="true"><?= __('Edit image title') ?></div>

                    </div>
                    <div class="ml-auto text-muted">

                      <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-x mr-1"></i> <?= __('Delete') ?></a>
                    </div>
                  </div>
                </div>
              </div>


           <div class="col-sm-6 col-lg-4">
                <div class="card p-3">


            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="350" height="245" type="text/html" src="https://www.youtube.com/embed/DBXH9jJRaDk?autoplay=0&fs=0&iv_load_policy=3&showinfo=0&rel=0&cc_load_policy=0&start=0&end=0&origin=https://youtubeembedcode.com">
            </iframe>
              <div class="d-flex align-items-center px-2">

                    <div>
                      <div contenteditable="true"> <?= __('Edit image title') ?></div>

                    </div>
                    <div class="ml-auto text-muted">

                      <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-x mr-1"></i> <?= __('Delete') ?></a>
                    </div>
                  </div>
          </div>

        </div>

 </div>
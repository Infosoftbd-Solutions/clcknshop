<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                    <h4 class="card-title" style="padding-top: 15px;"><?= __('Edit  Theme') ?></h4>                 
            </div>

                <div class="card-body">
                
                <?= $this->Form->create(null, ['type'=>'file', 'url' => ['controller' => 'Stores', 'action'=> 'themeEdit',$theme->folder_name] ]) ?>

                <div class="mb-3">
                    <?php echo $this->TablerForm->control('name', ['value'=>$theme->name]); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->TablerForm->control('author', ['value'=>$theme->author]); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->TablerForm->control('version', ['value'=>$theme->version]); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->TablerForm->control('description', ['value'=>$theme->description,'type'=>'textarea']); ?>
                </div>
                
                <div class="mb-3">
                    <?php echo $this->TablerForm->control('preview', ['value'=>$theme->preview]); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->TablerForm->control('active', ['value'=>$theme->active,'options'=>['Inactive','Active']]); ?>
                </div>
                
                <div class="mb-3">
                    <?php echo $this->TablerForm->control('thumbnail', ['class' => 'form-control', 'required' => false,  'type' => 'file']); ?>
                </div>
                

                <div class="mb-4 mt-3">
                    <input type="submit" value="Save Theme" class="btn btn-primary">
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
  </div>


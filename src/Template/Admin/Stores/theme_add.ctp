<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                    <h4 class="card-title" style="padding-top: 15px;"><?= __('Add New Theme') ?></h4>
                </div>

                <div class="card-body">
                <?= $this->Form->create($theme, ['type'=>'file', 'url' => ['controller' => 'stores', 'action'=> 'themeAdd'] ]) ?>
                <div class="mb-3">
                    <?php echo $this->Form->control('name', ['class' => 'form-control']); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('author', ['class' => 'form-control']); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('version', ['class' => 'form-control']); ?>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('description', ['class' => 'form-control']); ?>
                </div>
                
                <div class="mb-3">
                    <?php echo $this->Form->control('preview', ['class' => 'form-control']); ?>
                </div>

                <div class="mb-3">
                    <?php echo $this->Form->control('thumbnail', ['class' => 'form-control', 'type' => 'file']); ?>
                </div>
                
                <div class="mb-3">
                    <?php echo $this->Form->control('link', ['label' => __('Template(zip)'), 'class' => 'form-control', 'type' => 'file']); ?>
                </div>

                <div class="mb-4 mt-3">
                    <input type="submit" value="Save Theme" class="btn btn-primary">
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
  </div>

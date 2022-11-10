<div class="row py-5">
    <div class="col-lg-4">
        <div class="card card-profile">

            <div class="card-body text-center">
                <span class="avatar avatar-xl" ><?= strtoupper(substr($user->first_name,0,1)) ?><?= strtoupper(substr($user->last_name,0,1)) ?></span>
                <h3 class="mb-3"><?= h($user->first_name) ?>  <?= h($user->last_name) ?></h3>
                <p class="mb-4">
                    <?= h($user->email) ?><br/>
                    <?= h($user->phone) ?>
                </p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title"><?= __('User Login Log') ?></h3>
            </div>
            <div class="card-body">

            </div>
        </div>

    </div>
    <div class="col-lg-8">
        <?= $this->Form->create($user, ['url' => $this->Url->build(['controller'=>'users', 'action' => 'profile', $user->id])]) ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= __('User Information') ?></h3>
            </div>
            <div class="card-body">

                    <div class="form-fieldset">
                        <div class="row">
                            <?= $this->TablerForm->control('first_name',['row'=>6]) ?>
                            <?= $this->TablerForm->control('last_name',['row'=>6]) ?>
                            <?= $this->TablerForm->control('email',['row'=>6]) ?>
                            <?= $this->TablerForm->control('phone',['row'=>6]) ?>
                        </div>
                    </div>

                    <div class="form-fieldset">
                        <div class="row">
                          <!--  <?php //echo $this->TablerForm->control('username', ['row' => 12, 'required', 'label' => 'Username']) ?> -->
                            <?= $this->TablerForm->control('password', ['row' => 12, 'label' => 'Password', 'placeholder'=> __('type new password to change password'), 'value' => '', 'required' => false]) ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" <?=(STORENAME=='fashion')?"disabled":""?> ><?= __('Save changes') ?></button>

            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>



<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

        });
    });

</script>

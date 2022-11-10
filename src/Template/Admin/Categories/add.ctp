<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row">
<div class="col-lg-12">


<div class="categories form large-9 medium-8 columns content">
    <?= $this->Form->create($category,['class'=>'card', 'id' => 'collection_form', 'type' => 'file']) ?>
       <div class="card-header">
                  <h4 class="card-title"><?php echo ucfirst($this->request->action);   ?> <?= __('Collection') ?> </h4>
    </div>
    <div class="card-body">
    <fieldset class="form-fieldset">

        <?php

            echo $this->TablerForm->control('name', ['required' => true]);
            echo $this->TablerForm->control('slug', ['required' => true]);
            echo $this->TablerForm->control('description', ['required' => true]);
           // echo $this->TablerForm->control('image', ['type'=>'file']);
        ?>

        <div class="form-group">
            <div class="form-label"><?= __('Collection Image') ?></div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image">
                <label class="custom-file-label"><?= __('Choose file') ?></label>
            </div>
        </div>
        <span data-match="<?= $category->manual_matching ?>" id="match_status"></span>
        <?php
            echo $this->TablerForm->control('manual_matching',['Match Type','selectgroup'=>1,'type'=>'radio','options'=>['Automatic Matching','Manual Matching']]);
          //  echo $this->TablerForm->control('image');
        ?>

        <div id="match_condition" class="row">
          <div class="col-lg-2 justify-content-left d-flex flex-wrap align-items-center">
          <label> <?= _('Match Conditions') ?> </label>
          </div>
          <div class="col-lg-10">
          <?php
          $match = json_decode($category->match_cond,true);
        //  pr($match);
          echo $this->TablerForm->control('match.title_match',['value'=>(isset($match['title_match'])?$match['title_match']:""), 'label'=> __('Product title match with')]);
          echo $this->TablerForm->control('match.type_match',['value'=>(isset($match['type_match'])?$match['type_match']:""),'label'=> __('Product type match with')]);
          echo $this->TablerForm->control('match.tag_match',['value'=>(isset($match['tag_match'])?$match['tag_match']:""),'label'=> __('Product tag match with')]);
          ?>
          </div>
        </div>

    </fieldset>


    </div>

    <div class="card-footer text-right">

      <div class="d-flex">

        <button type="submit" class="btn btn-primary ml-auto" id="save-collection-btn"><?=  __('Save Collection') ?></button>
      </div>
    </div>

  <?= $this->Form->end() ?>
</div>
</div>
</div>


<script>


  require(['jquery', 'selectize', 'jqtoast'], function ($, selectize) {
                    $(document).ready(function () {
                        let match = $("#match_status").attr('data-match')

                        if (match == 1){
                            $("#match_condition").hide();

                        }else{
                            $("#match_condition").show();
                        }

                        // $("#manual-matching-0").attr("checked", true);

                        $("#collection_form").submit(function (e){
                            let _this = this;
                            e.preventDefault();

                            if ($("#match_status").attr('data-match') == 0){
                                var title = $("#match-title-match").val().trim();
                                var type = $("#match-type-match").val().trim();
                                var tag = $("#match-tag-match").val().trim();

                                console.log(title)
                                console.log(type)
                                console.log(tag)

                                if (title.length == 0 && type.length == 0 && tag.length == 0){
                                    $.toast({
                                        heading: "Error",
                                        text: "Please enter your match condition",
                                        showHideTransition: 'slide',
                                        icon: 'info',
                                        position:'top-right',
                                    })
                                    return  false;
                                }
                            }
                            else{
                                $("#match-title-match").val('');
                                $("#match-type-match").val('');
                                $("#match-tag-match").val('');
                            }

                            _this.submit();
                        })



                        $("#name").focusout(function (e) {
                            $("#slug").val(convertToSlug($(this).val()))
                        });

                        function convertToSlug(Text)
                        {
                            return Text
                                .toLowerCase()
                                .replace(/ /g,'-')
                                .replace(/[^\w-]+/g,'');
                        }

                        $('#match-title-match,#match-type-match,#match-tag-match').selectize({
                            delimiter: ',',
                            persist: false,
                            create: function (input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                        });

                        $('input[type=radio][name=manual_matching]').change(function() {
                            console.log(this.value)

                            $("#match_status").attr('data-match', this.value)
                            if (this.value == 1){
                                $("#match_condition").hide();
                            }else{
                                $("#match_condition").show();
                            }
                        });

                    });

  });

</script>

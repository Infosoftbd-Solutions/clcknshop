<fieldset class="form-fieldset">

    <div class="form-group px-3">
        <label for="store_id">Store ID</label>
        <input type="text" class="form-control" placeholder="Store ID" name="options[store_id]" id="store_id" value="<?= isset($store_id) ? $store_id : '' ?>">
    </div>


    <div class="form-group px-3">
        <label for="store_password">Store Password</label>
        <input type="text" class="form-control" id="store_password" placeholder="Store Password" name="options[store_password]" value="<?= isset($store_password) ? $store_password : '' ?>">
    </div>


    <div class="form-group px-3">
        <label for="ssl_instruction_image">
            <p>Instruction Image</p>
            <?php
                if (empty($instruction_image) == false &&  file_exists(UPLOAD . "instruction_images/" . $instruction_image)){
                   echo '<img src="/' . UPLOAD . 'instruction_images/'. $instruction_image . '" alt="" width="250px" id="ssl_instruction_image_prev">';
                }

                else{
                    echo $this->Html->image("missing_image.png", ['width' => '250px', 'id' => 'ssl_instruction_image_prev']);
                }
            ?>


        </label>
        <input id="ssl_instruction_image" type="file" name="instruction_image" class="form-control" style="display: none">
    </div>
</fieldset>


<script>
    var image = document.getElementById("ssl_instruction_image");
    image.addEventListener("change", function (e) {
        var src = window.URL.createObjectURL(this.files[0]);
        document.getElementById("ssl_instruction_image_prev").src = src;
    });
</script>




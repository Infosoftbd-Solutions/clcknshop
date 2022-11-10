<?php foreach ($productMedia as $media) : ?>
    <div class="col-6 col-sm-4 col-md-3">
        <label class="imagecheck mb-4">
            <input name="selected_images" type="checkbox" value="<?= $media->id?>" class="imagecheck-input" <?php echo $media->variant_id == $variant_id ? 'checked':'' ?>  />
            <figure class="imagecheck-figure">
                <?= $this->Media->productImage($media->path,$media->product_id,['height'=>96,'width'=>96, 'class'=>'imagecheck-image']) ?>
            </figure>
        </label>
    </div>
<?php endforeach; ?>





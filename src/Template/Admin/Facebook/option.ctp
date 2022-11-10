<?php if (isset($options) && $action == 'page'): foreach ($options as $option):?>
        <option value="<?= $option['id']?>|<?= $option['name'] ?>|<?= $option['access_token'] ?>| <?= $option['picture']['url']?>"> <?= $option['name']?></option>
<?php
endforeach;
    if (!count($options))   printf("<option value='0'>%s</option>", __('No page available.'));
endif; ?>


<?php
    if (isset($options) && $action == 'business'):
        foreach ($options as $option):
    ?>
            <option value="<?= $option['id']?>| <?= $option['name'] ?>"> <?= $option['name']?> <?php if ($option['pages']) echo "(". $option['pages'].")"?></option>
<?php
        endforeach;
        if (!count($options)) printf("<option value='0'>%s</option>", __('No Business Manager available.'));
    endif;
?>


<?php
    if (isset($options) && $action == 'pixel'):
        foreach ($options as $option):
    ?>
            <option value="<?= $option['id']?>"> <?= $option['name']?> </option>
<?php
        endforeach;
        if (!count($options)) printf("<option value='0'>%s</option>", __('No Pixel account available.'));
    endif;
?>


<?php
if (isset($options) && $action == 'catalog'):
    foreach ($options as $option):
        ?>
        <option value="<?= $option['id']?>| <?= $option['name'] ?>"> <?= $option['name']?> (<?= $option['id']?>) </option>
    <?php
    endforeach;
    if (!count($options)) printf("<option value='0'>%s</option>", __('No Catalog available.'));
endif;
?>


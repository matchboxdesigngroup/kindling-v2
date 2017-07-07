<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:44 PM
 */

if (!$data) {
    return;
}

$items = $data->get('gallery');
if (!$items) {
    return;
}
?>
<div class="tight-container <?php esc_attr_e($data->get('wrapClass', '')); ?>">
    <?php swic_load_shared_module('module-title', ['title' => $data->get('title', '')]); ?>

    <div class="flexslider js-gallery-slider gallery-slider">
        <ul class="slides">
            <?php foreach ($items as $item) { ?>
                <?php $item = collect($item); ?>
                <?php include 'gallery-item.php'; ?>
            <?php } ?>
        </ul>
    </div>
</div>

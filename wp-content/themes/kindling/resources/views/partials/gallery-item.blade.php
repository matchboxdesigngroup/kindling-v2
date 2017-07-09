<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:45 PM
 */

if (!$item) {
    return;
}

$image = wp_get_attachment_image($item->get('image_id'), 'gallery-module-large');
$caption = $item->get('caption', '');
$link = $item->get('link', '');
$target = swic_link_target($item->get('target_blank', false));
$contentData = ['content' => $caption, 'class' => 'gallery-item-caption'];
?>
<li class="gallery-item loading">
    <div class="gallery-item-inner">
        <?php echo wp_kseS_post($image); ?>

        <?php if ($caption) { ?>
            <div class="gallery-item-caption-wrap">
                <?php if ($link) { ?>
                <a
                    href="<?php echo esc_url($link); ?>"
                    class="gallery-item-link"
                    target="<?php esc_attr_e($target); ?>">
                    <?php } ?>
                    <?php swic_load_shared_module('module-content', $contentData); ?>
                    <?php if ($link) { ?>
                </a>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
</li>

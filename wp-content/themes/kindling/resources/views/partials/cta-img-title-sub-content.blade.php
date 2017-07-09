<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:35 PM
 */

if (!$data) {
    return;
}

$image = wp_get_attachment_image($data->get('image_id'), 'featured-image-large');
?>
<div class="container <?php esc_attr_e($data->get('wrapClass', '')); ?>">
    <div class="cta-2-module-inner">
        <div class="cta-2-module-image">
            <?php echo wp_kses_post($image); ?>
        </div>

        <div class="cta-2-module-content">
            <?php swic_load_shared_module('module-title', ['title' => $data->get('title', '')]); ?>
            <?php swic_load_shared_module('module-subtitle', ['subtitle' => $data->get('subtitle', '')]); ?>
            <?php swic_load_shared_module('module-content', ['content' => $data->get('content', '')]); ?>
        </div>
    </div>
</div>

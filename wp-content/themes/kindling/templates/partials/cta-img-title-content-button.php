<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:37 PM
 */

if (!$data) {
    return;
}

$fullWidth = (bool) $data->get('full_width', false);
$widthClass = $fullWidth ? 'container cta-3-full-width' : 'tight-container';
$wrapClass = $data->get('wrapClass', '') . " {$widthClass}";
$wrapClass = $data->get('content', '') ? "{$wrapClass} has-content" : $wrapClass;
$titleData = ['title' => $data->get('title', '')];
$imageSize = $fullWidth ? 'cta-3-module-full-width' : 'cta-3-module';
$image = wp_get_attachment_image($data->get('image_id'), $imageSize);
$contentData = ['content' => $data->get('content', '')];
$buttonData = [
    'buttonLabel' => $data->get('button_label', ''),
    'buttonLink' => $data->get('button_link', ''),
    'targetBlank' => $data->get('target_blank', false),
];
?>
<div class="<?php esc_attr_e($wrapClass); ?>">
    <div class="cta-3-module-inner">
        <div class="cta-3-module-image">
            <?php echo wp_kses_post($image); ?>
        </div>

        <div class="cta-3-module-content">
            <?php swic_load_shared_module('module-title', $titleData); ?>
            <?php swic_load_shared_module('module-content', $contentData); ?>
            <?php swic_load_shared_module('module-button', $buttonData); ?>
        </div>
    </div>
</div>

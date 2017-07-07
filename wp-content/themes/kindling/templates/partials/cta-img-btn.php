<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:34 PM
 */
use Kindling\Image;

if (!$data) {
    return;
}

$titleData = ['title' => $data->get('title', '')];
$image = (new Image($data->get('image_id')))->loadVisibleHTML('cta-1-module');

$contentData = ['content' => $data->get('content', '')];
$buttonData = [
    'buttonLabel' => $data->get('button_label', ''),
    'buttonLink' => $data->get('button_link', ''),
    'targetBlank' => $data->get('target_blank', false),
];
?>
<div class="container <?php esc_attr_e($data->get('wrapClass', '')); ?>">
    <div class="cta-1-module-image cta-1-module-section">
        <?php echo $image; ?>
    </div>

    <div class="cta-1-module-content cta-1-module-section">
        <?php swic_load_shared_module('module-title', $titleData); ?>
        <?php swic_load_shared_module('module-content', $contentData); ?>
        <?php swic_load_shared_module('module-button', $buttonData); ?>
    </div>
</div>

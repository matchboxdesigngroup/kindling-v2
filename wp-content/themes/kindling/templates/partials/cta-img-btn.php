<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:34 PM
 *
 * attr: title: string, titleClass: string, text: string, textClass: string, buttonLabel: string, buttonClass: string, buttonTarget: string
 */
use Kindling\Image;

if (!$data) {
    return;
}

$title = isset($title) ? $title : '' ;

$image = (wp_get_attachment_image($image_id));

?>
<div class="container <?php esc_attr_e($data->get('wrapClass', '')); ?>">
    <div class="cta-1-module-image cta-1-module-section">
        <?php echo $image; ?>
    </div>

    <div class="cta-1-module-content cta-1-module-section">
        <?php view('partials/h3-title', [
                'title' => $title,
                'class' => $titleClass
        ]); ?>
        <?php view('partials/text', [
                'content' => $text,
                'class' => $textClass
        ]); ?>
        <?php view('partials/button', [
                'label' => $buttonLabel,
                'class' => $buttonClass,
                'link' => $buttonLink,
                'target' => $buttonTarget
        ]); ?>
    </div>
</div>

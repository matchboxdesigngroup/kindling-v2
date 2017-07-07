<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:30 PM
 */

if (!$data) {
    return;
}

$contentData = ['content' => $data->get('content', '')];
?>
<div class="tight-container <?php esc_attr_e($data->get('wrapClass', '')); ?>">
    <?php swic_load_shared_module('module-content', $contentData); ?>
</div>
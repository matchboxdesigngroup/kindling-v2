<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:41 PM
 */

if (!function_exists('gravity_form')) {
    return;
}

$form = $data->get('form', []);
$formId = isset($form['id']) ? intval($form['id']) : 0;
if (!$formId) {
    return;
}
?>
<div class="tight-container <?php esc_attr_e($data->get('wrapClass', '')); ?>">
    <?php
    gravity_form(
        $formId,
        $display_title = false,
        $display_description = false,
        $display_inactive = false,
        $field_values = null,
        $ajax = true
    ); ?>
</div>

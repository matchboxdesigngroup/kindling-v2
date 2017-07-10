<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:57 PM
 *
 * attr: link: string, target: string, class: string, label: string
 */


if (!$label || !$link) {
    return;
}

$target = isset($target) ? (bool) $targetBlank : false;
$class = isset($class) ? "{$class} module-btn btn" : 'module-btn btn';
?>
<button
    href="<?php echo esc_url($link); ?>"
    target="<?php esc_attr_e($target); ?>"
    class="<?php esc_attr_e($class); ?>">
    <?php esc_attr_e($label); ?>
</button>

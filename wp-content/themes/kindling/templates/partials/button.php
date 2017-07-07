<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:57 PM
 */


if (!$buttonLabel || !$buttonLink) {
    return;
}

$targetBlank = isset($targetBlank) ? (bool) $targetBlank : false;
$class = isset($class) ? "{$class} module-btn btn" : 'module-btn btn';
?>
<a
    href="<?php echo esc_url($buttonLink); ?>"
    target="<?php esc_attr_e(swic_link_target($targetBlank)); ?>"
    class="<?php esc_attr_e($class); ?>">
    <?php esc_attr_e($buttonLabel); ?>
</a>

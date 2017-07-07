<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:57 PM
 */

if (!$title) {
    return;
}

$class = isset($class) ? "{$class} module-title" : 'module-title';
?>
<h2 class="<?php esc_attr_e($class); ?>">
    <?php echo wp_kses_post($title); ?>
</h2>

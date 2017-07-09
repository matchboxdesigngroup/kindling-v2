<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:59 PM
 */


if (!$subtitle) {
    return;
}

$class = isset($class) ? "{$class} module-subtitle" : 'module-subtitle';
?>
<h3 class=" <?php esc_attr_e($class); ?>">
    <?php esc_attr_e($subtitle); ?>
</h3>

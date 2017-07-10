<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/7/17
 * Time: 2:59 PM
 *
 * attr: class: string, title: string
 */


if (!$title) {
    return;
}

$class = isset($class) ? $class : '';
?>
<h3 class=" <?php esc_attr_e($class); ?>">
    <?php esc_attr_e($title); ?>
</h3>

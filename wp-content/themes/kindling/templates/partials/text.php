<?php
/**
 * Created by PhpStorm.
 * User: djacobsmeyer
 * Date: 7/10/17
 * Time: 4:20 PM
 *
 * attr: class: string, text: string
 */
if (!$text) {
    return;
}

$class = isset($class) ? "{$class}" : '';
?>
<span class="<?php esc_attr_e($class); ?>">
    <?php echo $text; ?>
</span>

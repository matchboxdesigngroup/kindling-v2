<?php
$message = ucwords(kdev_get_environment_type());
$wordsLimit = 360 / strlen($message);
?>
<div class="mdg-environment-bar">
    <?php for ($i = 0; $i < $wordsLimit; $i++) { ?>
    <div class="mdg-environment-bar-message">
        <?php echo wp_kses_post($message); ?>
    </div>
    <?php } ?>
</div>

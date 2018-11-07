<?php
    get_header();
?>

Langue du site: <?= do_shortcode('[lang]'); ?>
<hr>
Addition: <?= do_shortcode('[addition a=10 b=32]A + B vaut:[/addition]'); ?>

<?php
    get_footer();
?>

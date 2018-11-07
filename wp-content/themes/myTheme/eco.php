<?php  // Template Name: Modele Eco ?>

<?php get_header(); ?>

<?php

    // Requête de récupération des articles de la catégorie "Ecologie"
    $args = [
        // "cat" => "5"
        "category_name" => "ecologie, high-tech"
    ];
    $query = new WP_Query($args);
    // var_dump($query);
?>

<div class="container">
    <?php
    if ($query->have_posts())
    {
        while($query->have_posts())
        {
            $query->the_post();
    ?>
            <div>
                <h3><?php the_title(); ?></h3>
                <div><?php the_content(); ?></div>
                <div><?php echo get_the_category_list(',', null, get_the_ID()); ?></div>
            </div><br /><br />
    <?php
        }
    }
    else
    {
    ?>
        <p>
            <?= __("Sorry, no posts matched your criteria."); ?>
        </p>
    <?php
    }
    ?>
</div>

<?php
    // Ré-initialise les requêtes de WordPress
    wp_reset_postdata();
?>


<?php get_footer(); ?>

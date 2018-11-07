<?php  // Template Name: Modele Films ?>

<?php get_header(); ?>

<?php

    // Requête de récupération des articles de la catégorie "Ecologie"
    $args = [
        // "cat" => "5"
        "post_type" => "movies"
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
                <?php
                    $actors = get_post_meta(get_the_ID(), "actors", true);
                    if (!empty($actors))
                    {
                        echo '<div>Acteurs : '.$actors.'</div>';
                    }

                    $editor = get_post_meta(get_the_ID(), "editor", true);
                    if (!empty($editor))
                    {
                        echo '<div>Editeur : '.$editor.'</div>';
                    }

                    $firstname = get_post_meta(get_the_ID(), "firstname", true);
                    if (!empty($firstname))
                    {
                        echo '<div>Prénom : '.$firstname.'</div>';
                    }

                    $lastname = get_post_meta(get_the_ID(), "lastname", true);
                    if (!empty($lastname))
                    {
                        echo '<div>Nom : '.$lastname.'</div>';
                    }

                ?>
                <div>Date de sortie : <?php echo get_post_meta(get_the_ID(), "release_date", true); ?></div>
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

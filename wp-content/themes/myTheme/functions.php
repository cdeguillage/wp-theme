<?php
// Déclaration de la constante _THEME pour éviter d'écrire plusieurs fois get_template_directory_uri()
if (!defined("_THEME"))
{
    define("_THEME", get_template_directory_uri());
}

// Activer la gestion des menus avec un menu fictif
add_action('init', 'register_my_menu');
function register_my_menu() {
    register_nav_menu("my-fake-menu", __("My Fake Menu" ));
}

// Ajout des feuilles de styles
function my_theme_styles()
{
    if (!is_admin())
    {
        wp_enqueue_style("style2",         _THEME."/assets/css/style2.css",        ["bootstrap"], "4.0.3", "all");
        wp_enqueue_style("boostrap-style", _THEME."/assets/css/bootstrap.min.css", [],            "4.1.3");
        wp_enqueue_style("carousel-style", _THEME."/assets/css/carousel.css");
        wp_enqueue_style("main-style",     _THEME."/assets/css/style.css");
    }
}
add_action("wp_loaded", "my_theme_styles");


// Ajout des scripts
function my_theme_scripts()
{
    if (!is_admin())
    {
        wp_enqueue_script("jquery-script",    _THEME."/assets/js/jquery-3.3.1.min.js", [], "3.3.1");
        wp_enqueue_script("popper-script",    _THEME."/assets/js/popper.min.js",       [], "1.0.0");
        wp_enqueue_script("bootstrap-script", _THEME."/assets/js/bootstrap.min.js",    ["jquery-script", "popper-script"], "0.1");
        wp_enqueue_script("holder-script",    _THEME."/assets/js/holder.min.js",       [], "1.0.0");
    }
}
add_action("wp_loaded", "my_theme_scripts");

// Active la balise title
function add_title_tag()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'add_title_tag');

// function shortcode
if (!function_exists("shortcode"))
{
    function shortcode(string $tag, array $params = [])
    {
        foreach($param as $key => $value)
        {
            if (is_bool($value))
            {
                $value = isbool($value) ? "'true'" : "'false'";
            }
            elseif(is_string($value))
            {
                $value = "'$value'";
            }

            array_push($params, $key."=".$value);
            unset($params[$key]);
        }
        return do_shortcode("[".$tag." ".implode(" ", $params)."]");
    }
}

// Création d'un shortcode qui affiche la langue du site
// [lang]
function get_language()
{
    return bloginfo("language");
}
add_shortcode("lang", "get_language");

// Shortcode addition
function addition($atrributes, $content, $tag)
{
    // var_dump($atrributes);
    // var_dump($content);
    // var_dump($tag);

    return $content.($atrributes['a'] + $atrributes['b']);
}
add_shortcode("addition", "addition");

// Créer une page "éco", une page "high-tech" avec leur modèle PHP

// Custom Post - Post personnalisé
function movie_custom_post_type()
{
    // Définition des labels texte
    $labels = [
        "name" => _x("Film", "Films"),
        "add_new" => __("Créer une fiche de film")
        // "menu_name" => __("Nos films et séries")
    ];

    // Définition des paramètres du post personnalisé
    $args = [
        "label" => __("Films et Séries"),
        "labels" => $labels,
        "public" => true,
        'menu_icon' => 'dashicons-video-alt2',
        "supports" => ['title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields']
    ];

    // Ajout du post au registre de WordPress
    register_post_type("movies", $args);
}
add_action('init', 'movie_custom_post_type');

// METABOX
function register_my_metaboxes()
{
    add_meta_box(
        "my-first-metabox",           // Identifiant
        __("Ma super metabox"),       // Titre
        "my_first_metabox_callback",  // Appel de la fonction de Callback
        "movies"                      // Post-type personnalisé
    );
}
add_action("add_meta_boxes", "register_my_metaboxes");

// Déclaration de la fonction Callback
function my_first_metabox_callback($post)
{ ?>
    <label>
        Prénom : <input type="text" name="firstname" value="<?= get_post_meta($post->ID, 'firstname', true); ?>">
    </label>
    <br />
    <label>
        Nom    : <input type="text" name="lastname" value="<?= get_post_meta($post->ID, 'lastname', true); ?>">
    </label>
<?php }

// Enregistre les champs personnalisés
function save_my_metabox_fields($post_id)
{
    // FIRSTNAME
    // $firstname = get_post_meta($post_id, 'firstname', true);
    // if (empty($firstname))
    // {
    //     add_post_meta($post_id, "firstname", $_POST['firstname']);
    // }
    // else
    // {
    //     update_post_meta($post_id, "firstname", $_POST['firstname']);
    // }
    merge_post_data($post_id, "firstname", $_POST['firstname']);

    // LASTNAME
    // $lastname = get_post_meta($post_id, 'lastname', true);
    // if (empty($lastname))
    // {
    //     add_post_meta($post_id, "lastname", $_POST['lastname']);
    // }
    // else
    // {
    //     update_post_meta($post_id, "lastname", $_POST['lastname']);
    // }
    merge_post_data($post_id, "lastname", $_POST['lastname']);

}
add_action("save_post", "save_my_metabox_fields");


/////////////////////////////////////////////////////////////////
// Add or update the datas if exists
/////////////////////////////////////////////////////////////////
function merge_post_data($post_id, $field_name, $field_data)
{
    // Field
    $field = get_post_meta($post_id, $field_name, true);
    if (empty($field))
    {
        add_post_meta($post_id, $field_name, $field_data);
    }
    else
    {
        update_post_meta($post_id, $field_name, $field_data);
    }
}


?>
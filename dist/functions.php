<?php

// RECUPERE L'ID DU POST
function get_the_post_id() {
  if (in_the_loop()) {
       $post_id = get_the_ID();
  } else {
       global $wp_query;
       $post_id = $wp_query->get_queried_object_id();
         }
  return $post_id;
};

/* -------------------------------------------

# SCRIPTS ET STYLES

------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'global_enqueues' );
function global_enqueues() {

  if ( !is_admin() ) {

    wp_dequeue_style( 'dashicon' );

    //* Déplace jquery dans footer
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array(), '3.5.1', true );
    wp_enqueue_script( 'jquery' );

  };

  //* Charge le fichier main.css
  wp_enqueue_style( 'mainCss' , get_stylesheet_directory_uri() . '/css/main.css' );
  //* Charge les polices
  wp_enqueue_style( 'font-serif', 'https://fonts.googleapis.com/css2?family=Playfair+Display+SC&display=swap' );
  wp_enqueue_style( 'font-sans-serif' , 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap' );

  //* MASONRY (A CONCATENER + MINIFIER)
  if ( is_singular() && !is_front_page() ) {
    wp_enqueue_script( 'masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'imagesLoaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array(), '1.0.0', true );
  }
  wp_enqueue_script( 'mainJs', get_stylesheet_directory_uri() . '/js/main.js', array(), '1.0.0', true );

  //* CONTACT FORM 7
  if ( !is_page( 'contact' ) ) {
    wp_dequeue_script('contact-form-7');
    wp_dequeue_style('contact-form-7');
  }

}

//* Retire le chargement des emoticones dans wp_head
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );




/* -------------------------------------------

# INSTALLATION GLOBALE

------------------------------------------- */

add_action( 'genesis_setup', 'global_setup', 15 );
function global_setup() {

  include_once( get_stylesheet_directory() . '/inc/genesis-change.php' );
  include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
  include_once( get_stylesheet_directory() . '/inc/accessibilite.php' );
  include_once( get_stylesheet_directory() . '/inc/navigation.php' );



}
//* Ajout de class aux elements
include_once( get_stylesheet_directory() . '/inc/class.php' );

/* -------------------------------------------

# DESACTIVE MICRODATA GENESIS

------------------------------------------- */

add_filter( 'genesis_disable_microdata', '__return_true' );

/* -------------------------------------------

# TRADUCTION

------------------------------------------- */

add_action( 'after_setup_theme', 'traduction' );
function traduction() {
  load_child_theme_textdomain( 'genesis', get_stylesheet_directory() . '/lib/languages/' );
}

/* -------------------------------------------

# .site-footer

------------------------------------------- */
add_action( 'genesis_footer', 'social_icons' );
function social_icons() {
  $facebook_icon = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   width="266.893px" height="266.895px" viewBox="0 0 266.893 266.895" enable-background="new 0 0 266.893 266.895"
   xml:space="preserve">
  <path id="Blue_1_" fill="" d="M248.082,262.307c7.854,0,14.223-6.369,14.223-14.225V18.812
  c0-7.857-6.368-14.224-14.223-14.224H18.812c-7.857,0-14.224,6.367-14.224,14.224v229.27c0,7.855,6.366,14.225,14.224,14.225
  H248.082z"/>
  <path id="f" fill="#000" d="M182.409,262.307v-99.803h33.499l5.016-38.895h-38.515V98.777c0-11.261,3.127-18.935,19.275-18.935
  l20.596-0.009V45.045c-3.562-0.474-15.788-1.533-30.012-1.533c-29.695,0-50.025,18.126-50.025,51.413v28.684h-33.585v38.895h33.585
  v99.803H182.409z"/>
  </svg>';

  $instagram_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
  <path
    d="M256,49.471c67.266,0,75.233.257,101.8,1.469,24.562,1.121,37.9,5.224,46.778,8.674a78.052,78.052,0,0,1,28.966,18.845,78.052,78.052,0,0,1,18.845,28.966c3.45,8.877,7.554,22.216,8.674,46.778,1.212,26.565,1.469,34.532,1.469,101.8s-0.257,75.233-1.469,101.8c-1.121,24.562-5.225,37.9-8.674,46.778a83.427,83.427,0,0,1-47.811,47.811c-8.877,3.45-22.216,7.554-46.778,8.674-26.56,1.212-34.527,1.469-101.8,1.469s-75.237-.257-101.8-1.469c-24.562-1.121-37.9-5.225-46.778-8.674a78.051,78.051,0,0,1-28.966-18.845,78.053,78.053,0,0,1-18.845-28.966c-3.45-8.877-7.554-22.216-8.674-46.778-1.212-26.564-1.469-34.532-1.469-101.8s0.257-75.233,1.469-101.8c1.121-24.562,5.224-37.9,8.674-46.778A78.052,78.052,0,0,1,78.458,78.458a78.053,78.053,0,0,1,28.966-18.845c8.877-3.45,22.216-7.554,46.778-8.674,26.565-1.212,34.532-1.469,101.8-1.469m0-45.391c-68.418,0-77,.29-103.866,1.516-26.815,1.224-45.127,5.482-61.151,11.71a123.488,123.488,0,0,0-44.62,29.057A123.488,123.488,0,0,0,17.3,90.982C11.077,107.007,6.819,125.319,5.6,152.134,4.369,179,4.079,187.582,4.079,256S4.369,333,5.6,359.866c1.224,26.815,5.482,45.127,11.71,61.151a123.489,123.489,0,0,0,29.057,44.62,123.486,123.486,0,0,0,44.62,29.057c16.025,6.228,34.337,10.486,61.151,11.71,26.87,1.226,35.449,1.516,103.866,1.516s77-.29,103.866-1.516c26.815-1.224,45.127-5.482,61.151-11.71a128.817,128.817,0,0,0,73.677-73.677c6.228-16.025,10.486-34.337,11.71-61.151,1.226-26.87,1.516-35.449,1.516-103.866s-0.29-77-1.516-103.866c-1.224-26.815-5.482-45.127-11.71-61.151a123.486,123.486,0,0,0-29.057-44.62A123.487,123.487,0,0,0,421.018,17.3C404.993,11.077,386.681,6.819,359.866,5.6,333,4.369,324.418,4.079,256,4.079h0Z"/>
  <path
    d="M256,126.635A129.365,129.365,0,1,0,385.365,256,129.365,129.365,0,0,0,256,126.635Zm0,213.338A83.973,83.973,0,1,1,339.974,256,83.974,83.974,0,0,1,256,339.973Z"/>
  <circle
    cx="390.476" cy="121.524" r="30.23"/>
  </svg>';

  $html = '<div class="social-icons">';
    $html .= '<a href="https://www.instagram.com/marine_fau44/" title="Compte Instagram Marine Fau">' . $instagram_icon . '</a>';
    $html .= '<a href="https://www.facebook.com/M-FAU-Photographie-2220969988010287/" title="Compte Facebook Marine Fau">' . $facebook_icon . '</a>';
  $html .= '</div>';

  echo $html;
}


/* -------------------------------------------

# LISTE GALERIE

------------------------------------------- */

add_action( 'genesis_after_entry', 'display_gallery_list' );
function display_gallery_list() {
  if ( is_page_template('templates/gallery-list.php') )  {
    ?>

      <ul class="list-style-none gallery-list">
        <?php wp_list_pages(
                  array(
                    'title_li'    => '',
                    'child_of'    => get_the_post_id(),
                    'show_date'   => '',
                    'date_format' => '',
                    'orderby'     => 'menu-order',
                    'link_before' => '<h2 class="gallery-list-title text-serif text-thin text-light no-margin-padding">',
                    'link_after'  => '</h2>',
                    'walker'      => new PageListWithThumb_Walker(),
                ) ); ?>
      </ul>

    <?php
}
}
class PageListWithThumb_Walker extends Walker {

    public $tree_type = 'page';

    public $db_fields = array(
        'parent' => 'post_parent',
        'id'     => 'ID',
    );

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        $indent  = str_repeat( $t, $depth );
        $output .= "{$n}{$indent}<ul class='children'>{$n}";
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        $indent  = str_repeat( $t, $depth );
        $output .= "{$indent}</ul>{$n}";
    }

    public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {


        if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        if ( $depth ) {
            $indent = str_repeat( $t, $depth );
        } else {
            $indent = '';
        }

        $css_class = array( 'page_item gallery-list-item', 'page-item-' . $page->ID );

        if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
            $css_class[] = 'page_item_has_children';
        }

        if ( ! empty( $current_page ) ) {
            $_current_page = get_post( $current_page );
            if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
                $css_class[] = 'current_page_ancestor';
            }
            if ( $page->ID == $current_page ) {
                $css_class[] = 'current_page_item';
            } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
                $css_class[] = 'current_page_parent';
            }
        } elseif ( get_option( 'page_for_posts' ) == $page->ID ) {
            $css_class[] = 'current_page_parent';
        }

        $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
        $css_classes = $css_classes ? ' class="' . esc_attr( $css_classes ) . '"' : '';

        if ( '' === $page->post_title ) {
            /* translators: %d: ID of a post. */
            $page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
        }

        $args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
        $args['link_after']  = empty( $args['link_after'] ) ? '' : $args['link_after'];

        $atts                 = array();
        $atts['href']         = get_permalink( $page->ID );
        $atts['aria-current'] = ( $page->ID == $current_page ) ? 'page' : '';


        $atts = apply_filters( 'page_menu_link_attributes', $atts, $page, $depth, $args, $current_page );

        $attributes = '';
        // Récupération de la miniature dans une variable $thumb
        $thumb = get_the_post_thumbnail($page->ID, '');
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $output .= $indent . sprintf(
            '<li%s><a%s>%s%s%s%s</a>',
            $css_classes,
            $attributes,
            $thumb,
            $args['link_before'],
            apply_filters( 'the_title', $page->post_title, $page->ID ),
            $args['link_after']
        );

        if ( ! empty( $args['show_date'] ) ) {
            if ( 'modified' == $args['show_date'] ) {
                $time = $page->post_modified;
            } else {
                $time = $page->post_date;
            }

            $date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
            $output     .= ' ' . mysql2date( $date_format, $time );
        }
    }


    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
        if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
            $t = "\t";
            $n = "\n";
        } else {
            $t = '';
            $n = '';
        }
        $output .= "</li>{$n}";
    }

}


/* -------------------------------------------

# FRONT PAGE

Contenu de la page d'accueil (inutile de créer un fichier front-page.php)
------------------------------------------- */
add_action('front_page_content_area', 'front_page_content' );
function front_page_content() {
  $html = '<main class="front-page">';
    $html .= '<div class="front-page-content">';
      $html .= '<h1 class="text-serif text-light text-thin no-margin-padding">Marine Fau</h1>';
      $html .= '<h2 class="text-sans-serif text-dark text-thin no-margin-padding">Artiste Photographe sur Nantes</h2>';
    $html .= '</div>';
  $html .= '</main>';

  echo $html;
}

/* -------------------------------------------

# PAGE PROTEGEE

Supprime le mot "Protégé(e)" avant le titre d'une page protégée
------------------------------------------- */
add_filter( 'protected_title_format', 'remove_protected_text' );
  function remove_protected_text() {
    return __('%s');
  }

/* -------------------------------------------

# PAGE AIDE nicolasbolzinger.github.io/aide

Lien vers de la documentation WordPress intégré au panneau d'administration
------------------------------------------- */

// add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Aide WordPress', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<p>Besoin d\'aide sur la prise en main de WordPress ?<br> N\'hésitez pas à consulter la <a href="https://nicolasbolzinger.github.io/aide/index.html" title="Documentation WordPress">documentation</a>. <br>Contacter votre webmaster : hello@nicolasbolzinger.com</p>';
}

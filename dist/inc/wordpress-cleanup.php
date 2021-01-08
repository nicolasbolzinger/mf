<?php

//* Nettoie les class par défaut du body
add_filter( 'body_class', 'clean_body_classes', 20 );
function clean_body_classes( $classes ) {

  $allowed_classes = [
    'singular',
    'single',
    'page',
    'archive',
    'admin-bar',
    'full-width-content',
    'content-sidebar',
    'content',
  ];

  return array_intersect( $classes, $allowed_classes );

}


//* Ajoute la class .singular sur la balise body
add_filter( 'body_class', 'singular_body_class' );
function singular_body_class( $classes ) {
  if( is_singular() && !is_front_page() )
    $classes[] = 'singular';
    return $classes;
}


//* Nettoie les class par défaut de la balise article
add_filter( 'post_class', 'clean_post_classes', 5 );
function clean_post_classes( $classes ) {

  if( ! is_array( $classes ) )
    return $classes;

    $allowed_classes = array(
      'hentry',
      'type-' . get_post_type(),
    );

  return array_intersect( $classes, $allowed_classes );
}

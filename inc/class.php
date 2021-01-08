<?php
/* -------------------------------------------

# CLASS.PHP

------------------------------------------- */

//* Ajout class .site-container
add_filter('genesis_attr_site-container', 'site_container_add_class');
function site_container_add_class($attributes) {
  if ( is_front_page() ) {
  	$attributes['class'] = $attributes['class']. ' front-page-background';
  	return $attributes;
  }
  else {
    return $attributes;
  }
}

//* Ajout class .site-inner
add_filter('genesis_attr_site-inner', 'site_inner_add_class');
function site_inner_add_class($attributes) {
  if ( is_front_page() ) {
  	$attributes['class'] = $attributes['class']. ' max-width';
  	return $attributes;
  }
  else {
    return $attributes;
  }
}

//* Ajout class .site-header
add_filter( 'genesis_attr_site-header', 'header_add_class' );
function header_add_class( $attributes ) {
  if ( is_front_page() ) {
    $attributes['class'] = $attributes['class']. ' position-hf position-hf-top';
    return $attributes;
  }
  else {
  $attributes['class'] = $attributes['class']. ' position-hf position-hf-top singular';
    return $attributes;
  }
}

//* Ajout class .site-content
add_filter( 'genesis_attr_content', 'content_add_class' );
function content_add_class( $attributes ) {
  $attributes['class'] = $attributes['class']. ' max-width';
    return $attributes;
}
//* Ajout class .site-footer
add_filter( 'genesis_attr_site-footer', 'footer_add_class' );
function footer_add_class( $attributes ) {
  $attributes['class'] = $attributes['class']. ' position-hf position-hf-bottom text-thin text-dark';
    return $attributes;
}

//* Ajout class .entry-title
add_filter( 'genesis_attr_entry-title', 'entry_title_add_class' );
function entry_title_add_class( $attributes ) {
  $attributes['class'] = $attributes['class']. ' text-light text-serif text-align-center font-size-2';
    return $attributes;
}

//* Ajout class .entry-title
add_filter( 'genesis_attr_entry-content', 'entry_content_add_class' );
function entry_content_add_class( $attributes ) {
  $attributes['class'] = $attributes['class']. ' text-thin';
    return $attributes;
}

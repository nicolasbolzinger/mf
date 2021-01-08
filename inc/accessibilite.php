<?php

add_theme_support(
  'genesis-accessibility',
  array(
    '404-page',
    // 'drop-down-menu',
    'headings',
    'rems',
    'search-form',
    'skip-links',
  )
);

//* Supprime les ancres par défaut des skip-links
add_filter('genesis_skip_links_output','remove_nav_skiplink');
function remove_nav_skiplink( $links ) {
	unset( $links['genesis-content'] );
  unset( $links['genesis-sidebar-primary'] );
	return $links;
}

//* Modifie les ancres des skip-links
add_filter('genesis_skip_links_output','remove_custom_skiplink');
function remove_custom_skiplink( $links ) {
  $links['nav-principal'] = esc_html__( 'Accès au menu principal', 'genesis' );
	$links['main-content'] = esc_html__( 'Accès au contenu principal', 'genesis' );
	return $links;
}

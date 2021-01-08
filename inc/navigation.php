<?php

add_theme_support( 'genesis-menus',
  array(
    // 'primary' => __( 'Primary Navigation Menu', 'genesis' ),
    // 'secondary' => __( 'Secondary Navigation Menu', 'genesis' )
    'menu-principal' => __( 'Menu Principal', 'genesis' )
  )

);

add_action( 'genesis_site_title', 'site_branding');
function site_branding() {
        $siteUrl = esc_html( get_bloginfo('url') );
        $nom = esc_html( get_bloginfo( 'name' ) );
        $desc = esc_html( get_bloginfo( 'description' ) );
        $logo = esc_url( get_stylesheet_directory_uri() . '/images/marine-fau-logo.png' );

        if ( is_front_page() ) {
            $html .= '<img src="' . $logo . '" alt="Marine Fau - Logo" width="70px" height="70px">';
        }

        else {
            $html = '<a href="' . $siteUrl . '" title="Accueil - Marine Fau">';
            $html .= '<h1 class="no-margin-padding text-serif text-light text-thin font-size-3">' . $nom . '</h1>';
            $html .= '<h2 class="no-margin-padding text-sans-serif text-dark text-thin font-size-5">' . $desc . '</h2>';
            $html .= '</a>';
        }

  echo $html;
}

//* Supprime la navigation après le bloc .site-header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
//* Ajoute la navigation dans le bloc .site-header
add_action( 'genesis_header', 'genesis_do_nav' );

//* Modifie class des items dans le menu
add_filter( 'nav_menu_css_class', 'clean_nav_menu_classes', 5 );
function clean_nav_menu_classes( $classes ) {
  if( ! is_array( $classes ) )
    return $classes;

	foreach( $classes as $i => $class ) {

      //* Retire class .menu-item-ID
      $id = strtok( $class, 'menu-item-' );
      if( 0 < intval( $id ) )
		unset( $classes[ $i ] );

      //* Retire class .menu-item-type-*
      if( false !== strpos( $class, 'menu-item-type-' ) )
		unset( $classes[ $i ] );

      //* Retire class .menu-item-object-*
      if( false !== strpos( $class, 'menu-item-object-' ) )
		unset( $classes[ $i ] );

      // Change page ancestor to menu ancestor
      if( 'current-page-ancestor' == $class ) {
		$classes[] = 'current-menu-ancestor';
		  unset( $classes[ $i ] );
      }
	}

	//* Retire la class du sous-menu si depth est limitée
	if( isset( $args->depth ) && 1 === $args->depth ) {
      $classes = array_diff( $classes, array( 'menu-item-has-children' ) );
	}

	return $classes;
}


add_action( 'genesis_header', 'appel_menu_principal' );
function appel_menu_principal() {

  $icon_open = '<span class="open open-top"></span><span class="open open-center"></span><span class="open open-bottom"></span>';
  $icon_close = '<span class="close"></span>';

  $buttonClose = '<li class="mobile-only"><button id="menu-close" class="menu-toggle">' . $icon_close . '</button></li>';
  $buttonOpen = '<button id="menu-open" class="menu-toggle mobile-only">' . $icon_open . '</button>';
  wp_nav_menu( array(
  		'theme_location'  => 'menu-principal',
  		'container'       => 'nav',
        'container_id'    => 'nav-principal',
  		'container_class' => 'nav-primary nav-top',
  		'menu_class'      => 'menu nav-menu text-light text-thin',
  		'depth'           => 0,
  		'items_wrap'      => '' . $buttonOpen . '<ul id="%1$s" class="%2$s">' . $buttonClose . '%3$s</ul>',
  	) );

}

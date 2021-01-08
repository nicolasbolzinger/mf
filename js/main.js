/* -------------------------------------------

# NAV JS

------------------------------------------- */
let menuOpen = document.getElementById('menu-open');
let menuClose = document.getElementById('menu-close');
let mainNav = document.getElementById('menu-menu-principal');

menuOpen.addEventListener('click', event =>{
    if ( mainNav.style.right === '0px' ) {
        mainNav.style.right = '-270px';
    } else {
        mainNav.style.right = '0px';
    }
});
menuClose.addEventListener('click', event =>{
    mainNav.style.right = '-270px';
});

/* -------------------------------------------

# DROPDOWN MENU

------------------------------------------- */
// Storage du li parent
let parentItem = document.querySelectorAll('.menu-item-has-children');

// Boucle pour chaque li
for ( i = 0; i < parentItem.length; i++ ) {
    // Storage de la balise a du li parent
    let parentItemLink = parentItem[i].querySelector('a');
    // Storage du sous-menu
    let subMenu = parentItem[i].querySelector('.sub-menu');

    // Evènement clic uniquement sur la balise a
    parentItemLink.addEventListener('click', event => {

        event.preventDefault();

        if ( subMenu.style.display === 'block' ) {
            subMenu.style.display = 'none'
        } else {
            subMenu.style.display = 'block'
        }

    })
}
/* -------------------------------------------

# MASONRY JS

------------------------------------------- */
var post = document.querySelector('.entry-content');
imagesLoaded( post ).on( 'progress', function(){
  var elem3 = document.querySelectorAll('.columns-3'),
      elem2 = document.querySelectorAll('.columns-2'),
      elem1 = document.querySelectorAll('.columns-1'),
      n3 = elem3.length,
      n2 = elem2.length,
      n1 = elem1.length;
      for(var i = 0; i < n3; i++) {
        msnry3 = new Masonry( elem3[i], {
          itemSelector: '.blocks-gallery-item',
          columnWidth: 400,
        });
      };
      for(var i = 0; i < n2; i++) {
        msnry3 = new Masonry( elem2[i], {
          itemSelector: '.blocks-gallery-item',
          columnWidth: 600,
        });
      };
      for(var i = 0; i < n1; i++) {
        msnry3 = new Masonry( elem1[i], {
          itemSelector: '.blocks-gallery-item',
          columnWidth: 1200,
        });
      };
});

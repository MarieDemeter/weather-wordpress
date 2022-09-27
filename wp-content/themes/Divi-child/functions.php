<?php // Opening PHP tag - nothing should be before this, not even whitespace
// Custom Function to Include
function my_favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />' . "\n";
}
function allow_svgimg_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'allow_svgimg_types');
add_action( 'wp_head', 'my_favicon_link' );


function capitaine_register_post_types() {
  // CPT Portfolio
  $labels = array(
      'name' => 'Portfolio',
      'all_items' => 'Tous les projets',  // affiché dans le sous menu
      'singular_name' => 'Projet',
      'add_new_item' => 'Ajouter un projet',
      'edit_item' => 'Modifier le projet',
      'menu_name' => 'Portfolio'
  );
$args = array(
      'labels' => $labels,
      'public' => true,
      'show_in_rest' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'editor','thumbnail' ),
      'menu_position' => 5,
      'menu_icon' => 'dashicons-admin-customizer',
);
register_post_type( 'portfolio', $args );
}
add_action( 'init', 'capitaine_register_post_types' ); // Le hook init lance la fonction
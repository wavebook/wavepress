 <?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function wavebook_theme_enqueue_styles() {
  $parent_style      = 'parent-style';
  $child_style       = 'child-style';
  $parent_stylesheet = get_template_directory_uri()   . '/style.css';
  $child_stylesheet  = get_stylesheet_directory_uri() . '/style.css';
  $theme_version     = wp_get_theme()->get('Version');
  wp_enqueue_style($parent_style, $parent_stylesheet);
  //wp_enqueue_style($child_style, $child_stylesheet, array($parent_style), $theme_version);
}
add_action('wp_enqueue_scripts', 'wavebook_theme_enqueue_styles');


function posts_for_current_subscriber($query) {
  if      (!$query->is_main_query() || $query->is_admin) { }
  else if ($query->is_posts_page) {
    if      (current_user_can('administrator')) { }
    else if (current_user_can('subscriber')) {
      $query->set('author', get_current_user_id());
    }
  }
  return $query;
}
add_filter('pre_get_posts', 'posts_for_current_subscriber');

function new_template( $template ) {
  $new_template = locate_template(array('template-narrow.php'));
  if (!empty( $new_template)) { return $new_template; }
  else                        { return $template; }
}
add_filter('single_template', 'new_template', 99);

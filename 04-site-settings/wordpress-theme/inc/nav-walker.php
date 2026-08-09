<?php
/**
 * SolderBlog — кастомный Walker для навигации
 * Убирает <ul> и <li>, рендерит просто <a>
 */
class SolderBlog_Nav_Walker extends Walker_Nav_Menu {

  public function start_lvl(&$output, $depth = 0, $args = null) {}
  public function end_lvl(&$output, $depth = 0, $args = null) {}

  public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
    $item    = $data_object;
    $classes = empty($item->classes) ? [] : (array) $item->classes;
    $is_cta  = in_array('menu-cta', $classes);
    $active  = in_array('current-menu-item', $classes) ? ' active' : '';
    $cta     = $is_cta ? ' site-nav__cta' : '';

    $output .= sprintf(
      '<a href="%s" class="%s"%s>%s</a>',
      esc_url($item->url),
      'site-nav__link' . $active . $cta,
      $item->target ? ' target="_blank" rel="noopener"' : '',
      esc_html($item->title)
    );
  }

  public function end_el(&$output, $data_object, $depth = 0, $args = null) {}
}

function solderblog_fallback_nav() {
  $pages = get_pages(['sort_column' => 'menu_order']);
  foreach ($pages as $page) {
    echo '<a href="' . esc_url(get_permalink($page->ID)) . '" class="site-nav__link">' . esc_html($page->post_title) . '</a>';
  }
}

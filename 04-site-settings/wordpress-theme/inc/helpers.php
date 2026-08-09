<?php
/**
 * SolderBlog — helpers.php
 * Хлебные крошки, размеры изображений, shortcode для callout и TOC
 */

/* -------------------------------------------------------
   ХЛЕБНЫЕ КРОШКИ
------------------------------------------------------- */
function solderblog_breadcrumbs() {
  if (is_front_page()) return;
  echo '<nav class="breadcrumbs container" aria-label="' . __('Путь', 'solderblog') . '">';
  echo '<a href="' . esc_url(home_url('/')) . '">' . __('Главная', 'solderblog') . '</a>';
  echo '<span class="breadcrumbs__sep" aria-hidden="true">/</span>';

  if (is_category()) {
    echo '<span>' . single_cat_title('', false) . '</span>';
  } elseif (is_single()) {
    $cats = get_the_category();
    if ($cats) {
      echo '<a href="' . esc_url(get_category_link($cats[0]->term_id)) . '">' . esc_html($cats[0]->name) . '</a>';
      echo '<span class="breadcrumbs__sep" aria-hidden="true">/</span>';
    }
    echo '<span>' . esc_html(get_the_title()) . '</span>';
  } elseif (is_page()) {
    echo '<span>' . esc_html(get_the_title()) . '</span>';
  } elseif (is_search()) {
    echo '<span>' . __('Поиск', 'solderblog') . '</span>';
  }
  echo '</nav>';
}

/* -------------------------------------------------------
   РАЗМЕРЫ ИЗОБРАЖЕНИЙ
------------------------------------------------------- */
function solderblog_register_image_sizes() {
  add_image_size('solderblog-hero',  1600, 900,  true);
  add_image_size('solderblog-card',  720,  405,  true);
  add_image_size('solderblog-thumb', 400,  225,  true);
}
add_action('after_setup_theme', 'solderblog_register_image_sizes');

/* -------------------------------------------------------
   SHORTCODE: CALLOUT
   Использование: [callout type="warn"]Текст[/callout]
------------------------------------------------------- */
function solderblog_callout_shortcode($atts, $content = '') {
  $atts = shortcode_atts(['type' => 'info', 'title' => ''], $atts);
  $icons = ['warn' => '⚠️', 'danger' => '❗', 'info' => 'ℹ️'];
  $icon  = $icons[$atts['type']] ?? 'ℹ️';
  $title = $atts['title'] ? '<strong class="callout__title">' . esc_html($atts['title']) . '</strong><br>' : '';
  return sprintf(
    '<div class="callout callout--%s" role="note"><span class="callout__icon" aria-hidden="true">%s</span><div>%s%s</div></div>',
    esc_attr($atts['type']), $icon, $title, wp_kses_post($content)
  );
}
add_shortcode('callout', 'solderblog_callout_shortcode');

/* -------------------------------------------------------
   SHORTCODE: FAQ
   Использование:
   [faq]
   [faq_item q="Вопрос?"]Ответ[/faq_item]
   [/faq]
------------------------------------------------------- */
function solderblog_faq_shortcode($atts, $content = '') {
  return '<div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">' . do_shortcode($content) . '</div>';
}
function solderblog_faq_item_shortcode($atts, $content = '') {
  $atts = shortcode_atts(['q' => ''], $atts);
  return sprintf(
    '<details class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
      <summary itemprop="name">%s</summary>
      <div class="faq-item__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div itemprop="text">%s</div>
      </div>
    </details>',
    esc_html($atts['q']),
    wp_kses_post($content)
  );
}
add_shortcode('faq', 'solderblog_faq_shortcode');
add_shortcode('faq_item', 'solderblog_faq_item_shortcode');

/* -------------------------------------------------------
   EXCERPT — убираем [...] и ставим …
------------------------------------------------------- */
function solderblog_excerpt_more($more) { return '…'; }
add_filter('excerpt_more', 'solderblog_excerpt_more');

/* -------------------------------------------------------
   ПОДДЕРЖКА ФОРМАТОВ ЗАПИСЕЙ
------------------------------------------------------- */
add_action('after_setup_theme', function() {
  add_theme_support('post-formats', ['aside', 'gallery', 'video']);
});

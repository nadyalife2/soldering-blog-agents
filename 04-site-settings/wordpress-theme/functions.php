<?php
/**
 * SolderBlog — functions.php
 * Подключение стилей, скриптов, меню, кастомайзера,
 * Яндекс Метрики, cookie-баннера, schema.org
 */

defined('ABSPATH') || exit;

/* -------------------------------------------------------
   ИНКЛЮДЫ
------------------------------------------------------- */
require get_template_directory() . '/inc/nav-walker.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/reading-time.php';

/* -------------------------------------------------------
   БАЗОВЫЕ ПОДДЕРЖКИ ТЕМЫ
------------------------------------------------------- */
add_action('after_setup_theme', function () {
  load_theme_textdomain('solderblog', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
  add_theme_support('custom-logo');
  add_theme_support('customize-selective-refresh-widgets');

  register_nav_menus([
    'primary' => __('Основное меню', 'solderblog'),
    'footer'  => __('Меню в подвале', 'solderblog'),
  ]);
});

/* -------------------------------------------------------
   СТИЛИ И СКРИПТЫ
------------------------------------------------------- */
add_action('wp_enqueue_scripts', function () {
  $v = wp_get_theme()->get('Version');

  // Google Fonts
  wp_enqueue_style(
    'solderblog-fonts',
    'https://fonts.googleapis.com/css2?family=Bitter:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap',
    [], null
  );

  // Основной CSS
  wp_enqueue_style('solderblog-style', get_stylesheet_uri(), ['solderblog-fonts'], $v);

  // Дополнительный CSS
  wp_enqueue_style('solderblog-extra', get_template_directory_uri() . '/style-extra.css', ['solderblog-style'], $v);

  // Основной JS
  wp_enqueue_script('solderblog-main', get_template_directory_uri() . '/js/main.js', [], $v, true);

  // TOC (только для статей)
  if (is_single()) {
    wp_enqueue_script('solderblog-toc', get_template_directory_uri() . '/js/article-toc.js', [], $v, true);
  }

  // Cookie-баннер
  wp_enqueue_script('solderblog-cookie', get_template_directory_uri() . '/js/cookie-banner.js', [], $v, true);

  // Локализация для JS
  wp_localize_script('solderblog-main', 'SolderBlog', [
    'ajaxUrl'    => admin_url('admin-ajax.php'),
    'nonce'      => wp_create_nonce('solderblog_nonce'),
    'privacyUrl' => esc_url(home_url('/privacy/')),
    'strings'    => [
      'cookieText'   => __('Мы используем куки для аналитики. Никаких рекламных данных.', 'solderblog'),
      'cookieAccept' => __('Принять', 'solderblog'),
      'cookieDecline'=> __('Отказаться', 'solderblog'),
      'privacyLink'  => __('Политика конфиденциальности', 'solderblog'),
    ],
  ]);
});

/* -------------------------------------------------------
   ЯНДЕКС МЕТРИКА
   Вставляется в <head> через wp_head только если
   задан ID в настройках темы.
------------------------------------------------------- */
add_action('wp_head', function () {
  $ym_id = get_theme_mod('solderblog_ym_id');
  if (!$ym_id || !is_numeric($ym_id)) return;
  $ym_id = (int) $ym_id;
  ?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function(m,e,t,r,i,k,a){
  m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
  m[i].l=1*new Date();
  for (var j = 0; j < document.scripts.length; j++) {
    if (document.scripts[j].src === r) { return; }
  }
  k=e.createElement(t),a=e.getElementsByTagName(t)[0];
  k.async=1;k.src=r;
  a.parentNode.insertBefore(k,a)
})(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
ym(<?php echo $ym_id; ?>, "init", {
  clickmap:true,
  trackLinks:true,
  accurateTrackBounce:true,
  webvisor:true
});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?php echo $ym_id; ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php
}, 1);

/* -------------------------------------------------------
   КАСТОМАЙЗЕР
------------------------------------------------------- */
add_action('customize_register', function ($wp_customize) {

  // Секция: Аналитика
  $wp_customize->add_section('solderblog_analytics', [
    'title'    => __('Аналитика', 'solderblog'),
    'priority' => 130,
  ]);
  $wp_customize->add_setting('solderblog_ym_id', ['sanitize_callback' => 'absint']);
  $wp_customize->add_control('solderblog_ym_id', [
    'label'       => __('ID Яндекс Метрики', 'solderblog'),
    'description' => __('Только цифры. Пример: 98765432', 'solderblog'),
    'section'     => 'solderblog_analytics',
    'type'        => 'number',
  ]);

  // Секция: Hero
  $wp_customize->add_section('solderblog_hero', [
    'title'    => __('Hero-блок', 'solderblog'),
    'priority' => 120,
  ]);
  $wp_customize->add_setting('solderblog_hero_image', ['sanitize_callback' => 'esc_url_raw']);
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'solderblog_hero_image', [
    'label'   => __('Скетч-иллюстрация Hero', 'solderblog'),
    'section' => 'solderblog_hero',
  ]));

  // Секция: Cookie
  $wp_customize->add_section('solderblog_cookie', [
    'title'    => __('Cookie-баннер', 'solderblog'),
    'priority' => 140,
  ]);
  $wp_customize->add_setting('solderblog_cookie_text', [
    'default'           => 'Мы используем куки для аналитики (Яндекс Метрика). Рекламные данные не собираются.',
    'sanitize_callback' => 'sanitize_text_field',
  ]);
  $wp_customize->add_control('solderblog_cookie_text', [
    'label'   => __('Текст баннера', 'solderblog'),
    'section' => 'solderblog_cookie',
    'type'    => 'textarea',
  ]);

});

/* -------------------------------------------------------
   СХЕМА РАЗМЕРОВ ИЗОБРАЖЕНИЙ
------------------------------------------------------- */
add_action('after_setup_theme', function () {
  add_image_size('solderblog-hero',  1600, 900,  true);
  add_image_size('solderblog-card',  720,  405,  true);
  add_image_size('solderblog-thumb', 400,  225,  true);
});

/* -------------------------------------------------------
   БЛОКИРОВКА XML-RPC
------------------------------------------------------- */
add_filter('xmlrpc_enabled', '__return_false');

/* -------------------------------------------------------
   УБИРАЕМ EMOJI-СКРИПТЫ WORDPRESS
------------------------------------------------------- */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

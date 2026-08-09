<?php
/**
 * SolderBlog — header.php
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="visually-hidden" href="#main-content"><?php _e('Перейти к содержимому', 'solderblog'); ?></a>

<header class="site-header" role="banner">
  <div class="site-header__inner">

    <!-- Логотип -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home" aria-label="<?php bloginfo('name'); ?>">
      <svg class="site-logo__icon" width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true">
        <rect x="14" y="2" width="4" height="14" rx="2" fill="#4A4A45"/>
        <rect x="13" y="14" width="6" height="6" rx="1" fill="#4A4A45"/>
        <path d="M16 20 L13 28 L16 26 L19 28 Z" fill="#D4571E"/>
        <circle cx="16" cy="27" r="2" fill="#F0A500" opacity="0.7"/>
      </svg>
      <?php
        $name  = get_bloginfo('name');
        $parts = preg_split('/([Бб]лог)/u', $name, 2, PREG_SPLIT_DELIM_CAPTURE);
        if (count($parts) >= 2) {
          echo esc_html($parts[0]);
          echo '<span>' . esc_html($parts[1]) . '</span>';
          if (!empty($parts[2])) echo esc_html($parts[2]);
        } else {
          echo esc_html($name);
        }
      ?>
    </a>

    <!-- Навигация -->
    <nav class="site-nav" id="site-navigation" role="navigation" aria-label="<?php _e('Основное меню', 'solderblog'); ?>">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'menu_class'     => '',
          'container'      => false,
          'walker'         => new SolderBlog_Nav_Walker(),
          'fallback_cb'    => 'solderblog_fallback_nav',
        ]);
      ?>
    </nav>

    <!-- Бургер-кнопка -->
    <button class="nav-toggle" aria-controls="site-navigation" aria-expanded="false" aria-label="<?php _e('Открыть меню', 'solderblog'); ?>">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <rect x="3" y="5" width="18" height="2" rx="1" fill="#1A1A18"/>
        <rect x="3" y="11" width="18" height="2" rx="1" fill="#1A1A18"/>
        <rect x="3" y="17" width="18" height="2" rx="1" fill="#1A1A18"/>
      </svg>
    </button>

  </div>
</header>

<main id="main-content" role="main">

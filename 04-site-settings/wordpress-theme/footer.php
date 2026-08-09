<?php
/**
 * SolderBlog — footer.php
 */
?>
</main><!-- /#main-content -->

<footer class="site-footer" role="contentinfo">
  <div class="site-footer__inner">

    <div class="footer-col">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo site-logo--footer">
        <svg width="24" height="24" viewBox="0 0 32 32" fill="none" aria-hidden="true">
          <rect x="14" y="2" width="4" height="14" rx="2" fill="#4A4A45"/>
          <rect x="13" y="14" width="6" height="6" rx="1" fill="#4A4A45"/>
          <path d="M16 20 L13 28 L16 26 L19 28 Z" fill="#D4571E"/>
          <circle cx="16" cy="27" r="2" fill="#F0A500" opacity="0.7"/>
        </svg>
        <?php bloginfo('name'); ?>
      </a>
      <p class="footer-col__desc"><?php bloginfo('description'); ?></p>
    </div>

    <div class="footer-col">
      <p class="footer-col__title"><?php _e('Разделы', 'solderblog'); ?></p>
      <?php
        wp_nav_menu([
          'theme_location' => 'footer',
          'menu_class'     => 'footer-col__links',
          'container'      => false,
          'depth'          => 1,
          'fallback_cb'    => false,
        ]);
      ?>
    </div>

    <div class="footer-col">
      <p class="footer-col__title"><?php _e('Инструменты', 'solderblog'); ?></p>
      <nav class="footer-col__links" aria-label="Инструменты">
        <a href="<?php echo esc_url(home_url('/podbor-flyusa/')); ?>"><?php _e('Подборщик флюса', 'solderblog'); ?></a>
        <a href="<?php echo esc_url(home_url('/kalkulator-temperatury-pajki/')); ?>"><?php _e('Калькулятор температуры', 'solderblog'); ?></a>
        <a href="<?php echo esc_url(home_url('/podbor-pripoya/')); ?>"><?php _e('Подборщик припоя', 'solderblog'); ?></a>
        <a href="<?php echo esc_url(home_url('/podbor-payalnika/')); ?>"><?php _e('Подборщик паяльника', 'solderblog'); ?></a>
        <a href="<?php echo esc_url(home_url('/diagnostika-defekta/')); ?>"><?php _e('Диагностика дефектов', 'solderblog'); ?></a>
      </nav>
    </div>

  </div>

  <div class="site-footer__bottom">
    <span class="footer-copy">
      &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
      <?php _e('Все изображения сгенерированы специально для сайта.', 'solderblog'); ?>
    </span>
    <nav class="footer-legal" aria-label="Юридическое">
      <a href="<?php echo esc_url(home_url('/privacy/')); ?>"><?php _e('Политика конфиденциальности', 'solderblog'); ?></a>
    </nav>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * SolderBlog — 404.php
 */
get_header();
?>

<section class="error-404 container">
  <div class="error-404__inner">
    <p class="error-404__code">404</p>
    <h1 class="error-404__title"><?php _e('Страница не найдена', 'solderblog'); ?></h1>
    <p class="error-404__text">
      <?php _e('Возможно, адрес изменился или страницу удалили.', 'solderblog'); ?>
    </p>
    <div class="error-404__actions">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary"><?php _e('На главную', 'solderblog'); ?></a>
      <a href="<?php echo esc_url(home_url('/podbor-flyusa/')); ?>" class="btn btn--secondary"><?php _e('Подобрать флюс', 'solderblog'); ?></a>
    </div>
  </div>
</section>

<?php get_footer(); ?>

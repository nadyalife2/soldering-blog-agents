<?php
/**
 * SolderBlog — search.php
 */
get_header();
?>

<section class="archive-header container">
  <h1 class="archive-header__title">
    <?php printf(__('Поиск: %s', 'solderblog'), '<span>' . esc_html(get_search_query()) . '</span>'); ?>
  </h1>
  <?php get_search_form(); ?>
</section>

<?php if (have_posts()) : ?>
<section class="posts-section container">
  <div class="posts-grid">
    <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('post-card sketch-card'); ?>>
      <div class="post-card__body">
        <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 22, '…'); ?></p>
        <a href="<?php the_permalink(); ?>" class="post-card__more"><?php _e('Читать', 'solderblog'); ?> →</a>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
  <nav class="pagination" aria-label="Страницы">
    <?php echo paginate_links(['mid_size' => 2, 'type' => 'list']); ?>
  </nav>
</section>
<?php else : ?>
<section class="not-found container">
  <p><?php _e('По вашему запросу ничего не найдено.', 'solderblog'); ?></p>
</section>
<?php endif; ?>

<?php get_footer(); ?>

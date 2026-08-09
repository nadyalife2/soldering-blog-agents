<?php
/**
 * SolderBlog — index.php
 * Главная / архив категорий (с пагинацией)
 */
get_header();

$is_home     = is_front_page() || is_home();
$is_category = is_category();
?>

<?php if ($is_home) : ?>
<!-- ===================== HERO ===================== -->
<section class="hero">
  <div class="hero__text">
    <p class="hero__eyebrow"><?php _e('Практический блог о пайке', 'solderblog'); ?></p>
    <h1><?php _e('Паяй уверенно — с правильными знаниями', 'solderblog'); ?></h1>
    <p><?php _e('Гайды, калькуляторы и диагностика дефектов. Коротко и по делу — без воды.', 'solderblog'); ?></p>
    <div class="hero__actions">
      <a href="<?php echo esc_url(get_category_link(get_category_by_slug('guides'))); ?>" class="btn btn--primary">
        <?php _e('Читать гайды', 'solderblog'); ?>
      </a>
      <a href="<?php echo esc_url(home_url('/podbor-flyusa/')); ?>" class="btn btn--secondary">
        <?php _e('Подобрать флюс', 'solderblog'); ?>
      </a>
    </div>
  </div>
  <div class="hero__image" aria-hidden="true">
    <?php
      $hero_img = get_theme_mod('solderblog_hero_image');
      if ($hero_img) {
        echo '<img src="' . esc_url($hero_img) . '" alt="" width="560" height="380" loading="eager">';
      } else {
        echo '<div class="hero__image-placeholder"></div>';
      }
    ?>
  </div>
</section>

<!-- ========= ФИЛЬТР ПО КАТЕГОРИЯМ ========= -->
<section class="category-filter container">
  <div class="category-filter__inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="category-pill <?php echo (!is_category()) ? 'active' : ''; ?>">
      <?php _e('Все', 'solderblog'); ?>
    </a>
    <?php
      $cats = get_categories(['hide_empty' => true, 'orderby' => 'count', 'order' => 'DESC']);
      foreach ($cats as $cat) :
    ?>
    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
       class="category-pill <?php echo is_category($cat->term_id) ? 'active' : ''; ?>">
      <?php echo esc_html($cat->name); ?>
      <span class="category-pill__count"><?php echo $cat->count; ?></span>
    </a>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<?php if ($is_category) : ?>
<!-- ======= ШАПКА КАТЕГОРИИ ======= -->
<section class="archive-header container">
  <?php solderblog_breadcrumbs(); ?>
  <h1 class="archive-header__title"><?php single_cat_title(); ?></h1>
  <?php if (category_description()) : ?>
    <p class="archive-header__desc"><?php echo category_description(); ?></p>
  <?php endif; ?>
</section>
<?php endif; ?>

<!-- ========== СЕТКА СТАТЕЙ ========== -->
<?php if (have_posts()) : ?>
<section class="posts-section container">
  <?php if ($is_home) : ?>
    <h2 class="section-title"><?php _e('Последние статьи', 'solderblog'); ?></h2>
  <?php endif; ?>

  <div class="posts-grid">
    <?php while (have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class('post-card sketch-card'); ?>>

        <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="post-card__thumb-link" tabindex="-1" aria-hidden="true">
          <?php the_post_thumbnail('solderblog-card', [
            'class'   => 'post-card__thumb',
            'loading' => 'lazy',
            'alt'     => '',
          ]); ?>
        </a>
        <?php endif; ?>

        <div class="post-card__body">
          <div class="post-card__meta">
            <?php
              $cats = get_the_category();
              if ($cats) :
            ?>
            <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="tag tag--accent">
              <?php echo esc_html($cats[0]->name); ?>
            </a>
            <?php endif; ?>
            <span class="post-card__read-time">
              <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                <circle cx="8" cy="8" r="6.5" stroke="#4A4A45" stroke-width="1.5"/>
                <path d="M8 4.5V8L10.5 9.5" stroke="#4A4A45" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
              <?php echo solderblog_reading_time(get_the_ID()); ?> мин
            </span>
          </div>

          <h2 class="post-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 22, '…'); ?></p>

          <a href="<?php the_permalink(); ?>" class="post-card__more">
            <?php _e('Читать', 'solderblog'); ?>
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
              <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>

      </article>

    <?php endwhile; ?>
  </div>

  <!-- ПАГИНАЦИЯ -->
  <nav class="pagination" role="navigation" aria-label="<?php _e('Страницы', 'solderblog'); ?>">
    <?php
      echo paginate_links([
        'prev_text' => '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>' . __('Назад', 'solderblog'),
        'next_text' => __('Далее', 'solderblog') . '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M6 4L10 8L6 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'mid_size'  => 2,
        'type'      => 'list',
      ]);
    ?>
  </nav>

</section>

<?php else : ?>

<section class="not-found container">
  <h2><?php _e('Статьи не найдены', 'solderblog'); ?></h2>
  <p><?php _e('Попробуйте выбрать другую категорию.', 'solderblog'); ?></p>
</section>

<?php endif; ?>

<?php get_footer(); ?>

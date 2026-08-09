<?php
/**
 * SolderBlog — single.php
 * Страница одной статьи
 */
get_header();
the_post();
?>

<?php solderblog_breadcrumbs(); ?>

<div class="article-layout">

  <!-- ====== ОСНОВНОЙ КОНТЕНТ ====== -->
  <article id="post-<?php the_ID(); ?>" <?php post_class('article-main'); ?> itemscope itemtype="https://schema.org/TechArticle">

    <!-- Шапка статьи -->
    <header class="article-header">
      <div class="article-header__meta">
        <?php
          $cats = get_the_category();
          if ($cats) :
        ?>
        <a href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>" class="tag tag--accent">
          <?php echo esc_html($cats[0]->name); ?>
        </a>
        <?php endif; ?>
        <time class="article-header__date" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
          <?php echo get_the_date('d.m.Y'); ?>
        </time>
        <span class="post-card__read-time">
          <?php echo solderblog_reading_time(get_the_ID()); ?> мин чтения
        </span>
      </div>

      <h1 class="article-header__title" itemprop="headline"><?php the_title(); ?></h1>

      <?php if (has_post_thumbnail()) : ?>
      <figure class="article-header__figure">
        <?php the_post_thumbnail('solderblog-hero', [
          'class'    => 'article-header__img',
          'loading'  => 'eager',
          'itemprop' => 'image',
        ]); ?>
        <?php if (get_the_post_thumbnail_caption()) : ?>
        <figcaption><?php echo get_the_post_thumbnail_caption(); ?></figcaption>
        <?php endif; ?>
      </figure>
      <?php endif; ?>
    </header>

    <!-- Тело статьи -->
    <div class="article-body" itemprop="articleBody">
      <?php the_content(); ?>
    </div>

    <!-- Навигация по статьям -->
    <nav class="article-nav" aria-label="<?php _e('Другие статьи', 'solderblog'); ?>">
      <?php
        $prev = get_previous_post();
        $next = get_next_post();
      ?>
      <?php if ($prev) : ?>
      <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="article-nav__link article-nav__link--prev">
        <span class="article-nav__label"><?php _e('← Предыдущая', 'solderblog'); ?></span>
        <span class="article-nav__title"><?php echo esc_html(get_the_title($prev)); ?></span>
      </a>
      <?php endif; ?>
      <?php if ($next) : ?>
      <a href="<?php echo esc_url(get_permalink($next)); ?>" class="article-nav__link article-nav__link--next">
        <span class="article-nav__label"><?php _e('Следующая →', 'solderblog'); ?></span>
        <span class="article-nav__title"><?php echo esc_html(get_the_title($next)); ?></span>
      </a>
      <?php endif; ?>
    </nav>

    <!-- Похожие статьи -->
    <?php
      $related = new WP_Query([
        'category__in'   => wp_get_post_categories(get_the_ID()),
        'post__not_in'   => [get_the_ID()],
        'posts_per_page' => 3,
        'orderby'        => 'rand',
      ]);
      if ($related->have_posts()) :
    ?>
    <section class="related-posts">
      <h2 class="section-title"><?php _e('Читайте также', 'solderblog'); ?></h2>
      <div class="posts-grid posts-grid--compact">
        <?php while ($related->have_posts()) : $related->the_post(); ?>
          <article class="post-card sketch-card">
            <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
              <?php the_post_thumbnail('solderblog-card', ['class' => 'post-card__thumb', 'loading' => 'lazy', 'alt' => '']); ?>
            </a>
            <?php endif; ?>
            <div class="post-card__body">
              <h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <a href="<?php the_permalink(); ?>" class="post-card__more"><?php _e('Читать', 'solderblog'); ?> →</a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </section>
    <?php endif; ?>

  </article>

  <!-- ====== САЙДБАР ====== -->
  <aside class="article-sidebar">

    <!-- Оглавление (генерируется JS) -->
    <div class="sidebar-block sketch-card" id="toc-sidebar">
      <p class="sidebar-block__title"><?php _e('Содержание', 'solderblog'); ?></p>
      <nav class="toc" aria-label="Оглавление">
        <ol class="toc__list" id="toc-list"><!-- JS --></ol>
      </nav>
    </div>

    <!-- Инструменты -->
    <div class="sidebar-block sketch-card">
      <p class="sidebar-block__title"><?php _e('Инструменты', 'solderblog'); ?></p>
      <ul class="sidebar-tools">
        <li><a href="<?php echo esc_url(home_url('/podbor-flyusa/')); ?>" class="sidebar-tools__link"><?php _e('Подобрать флюс', 'solderblog'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/kalkulator-temperatury-pajki/')); ?>" class="sidebar-tools__link"><?php _e('Калькулятор температуры', 'solderblog'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/podbor-pripoya/')); ?>" class="sidebar-tools__link"><?php _e('Подобрать припой', 'solderblog'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/diagnostika-defekta/')); ?>" class="sidebar-tools__link"><?php _e('Диагностика дефекта', 'solderblog'); ?></a></li>
      </ul>
    </div>

  </aside>

</div>

<?php get_footer(); ?>

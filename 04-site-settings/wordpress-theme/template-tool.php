<?php
/**
 * Template Name: Интерактивный инструмент
 * SolderBlog — template-tool.php
 *
 * Используй этот шаблон для страниц калькуляторов и подборщиков.
 * Подключает отдельный JS-файл инструмента через wp_enqueue_script.
 */
get_header();
the_post();

$slug        = get_post_field('post_name', get_the_ID());
$tool_script = get_template_directory_uri() . '/js/tools/' . $slug . '.js';
$tool_data   = get_template_directory_uri() . '/js/tools/' . $slug . '.data.json';

// Подключаем JS инструмента если файл существует
if (file_exists(get_template_directory() . '/js/tools/' . $slug . '.js')) {
  wp_enqueue_script('solderblog-tool-' . $slug, $tool_script, [], '1.0', true);
}
?>

<?php solderblog_breadcrumbs(); ?>

<div class="tool-page container">

  <!-- Шапка инструмента -->
  <header class="tool-header">
    <div class="tool-header__meta">
      <span class="tag tag--accent"><?php _e('Инструмент', 'solderblog'); ?></span>
    </div>
    <h1 class="tool-header__title"><?php the_title(); ?></h1>
    <?php if (get_the_excerpt()) : ?>
    <p class="tool-header__desc"><?php the_excerpt(); ?></p>
    <?php endif; ?>
  </header>

  <!-- Зона инструмента (заполняется through_content или JS) -->
  <div class="tool-wrap sketch-card" id="tool-app" role="region" aria-label="<?php the_title_attribute(); ?>">
    <?php the_content(); ?>
  </div>

  <!-- GEO-текст под инструментом (SEO) -->
  <?php
    $geo_text = get_post_meta(get_the_ID(), '_solderblog_geo_text', true);
    if ($geo_text) :
  ?>
  <section class="tool-seo-text">
    <?php echo wp_kses_post($geo_text); ?>
  </section>
  <?php endif; ?>

  <!-- Связанные статьи -->
  <?php
    $related_slugs = get_post_meta(get_the_ID(), '_solderblog_related_posts', true);
    if ($related_slugs) :
      $related_ids = array_map(function($s){ $p = get_page_by_path($s, OBJECT, 'post'); return $p ? $p->ID : 0; }, explode(',', $related_slugs));
      $related_ids = array_filter($related_ids);
      if ($related_ids) :
        $related = new WP_Query(['post__in' => $related_ids, 'orderby' => 'post__in']);
  ?>
  <section class="related-posts">
    <h2 class="section-title"><?php _e('По теме', 'solderblog'); ?></h2>
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
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </section>
  <?php endif; endif; ?>

</div>

<?php get_footer(); ?>

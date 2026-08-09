<?php
/**
 * SolderBlog — page.php
 * Статичная страница (Политика, О сайте, Интерактив)
 */
get_header();
the_post();

$is_tool = has_term('tool', 'page-type') || in_array(get_page_template_slug(), ['template-tool.php']);
?>

<?php solderblog_breadcrumbs(); ?>

<?php if ($is_tool) : ?>
  <?php get_template_part('template', 'tool'); ?>
<?php else : ?>

<div class="content-page container">
  <article <?php post_class('content-article'); ?>>
    <header class="content-header">
      <h1 class="content-header__title"><?php the_title(); ?></h1>
    </header>
    <div class="article-body">
      <?php the_content(); ?>
    </div>
  </article>
</div>

<?php endif; ?>

<?php get_footer(); ?>

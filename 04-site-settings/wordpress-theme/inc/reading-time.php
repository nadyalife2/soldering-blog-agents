<?php
/**
 * SolderBlog — reading-time.php
 * Расчёт времени чтения статьи
 */
function solderblog_reading_time($post_id) {
  $content    = get_post_field('post_content', $post_id);
  $word_count = str_word_count(strip_tags($content));
  $minutes    = max(1, (int) round($word_count / 200));
  return $minutes;
}

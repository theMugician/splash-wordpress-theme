<?php

/**
 * Vigor Buttons Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

if (!function_exists('vigor_button_classes'))   {
  function vigor_button_classes ($size, $style) {
    $size_class = ' vigor-button--' . $size;
    $style_class = ' vigor-button--' . $style;
    $classes = 'vigor-button' . $size_class . $style_class;
    return $classes;
  }
}

$vigor_buttons = get_field('vigor_buttons'); ?>

<?php if( have_rows('vigor_buttons') ): ?>

  <div class="vigor-buttons">


  <?php while( have_rows('vigor_buttons') ) : the_row(); ?>

    <?php 
    $vigor_button_text = get_sub_field('vigor_button_text');
    $vigor_button_url = get_sub_field('vigor_button_url');
    $vigor_button_style = get_sub_field('vigor_button_style');
    $vigor_button_size = get_sub_field('vigor_button_size');

  ?>

    <a class="<?php echo vigor_button_classes($vigor_button_size,$vigor_button_style); ?>" href="#">
      <span><?php echo $vigor_button_text; ?></span>
    </a>

  <?php endwhile; ?>

  </div>

<?php endif; ?>
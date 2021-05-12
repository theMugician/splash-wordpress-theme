<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Splash
 */

?>

	<footer id="colophon" class="footer section background-color__black">

	<?php

	if ( is_active_sidebar( 'footer' ) ) : ?>

		<div class="container grid">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div><!-- .widget-area -->

	<?php endif; ?>


	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package webStart
 */

?>

<div class="site-layout-container">
	<?php if (is_active_sidebar('sidebar-1')) : ?>
		<?php dynamic_sidebar('sidebar-1'); ?>
	<?php endif; ?>
	<?php if (is_active_sidebar('sidebar-2')) : ?>
		<?php dynamic_sidebar('sidebar-1'); ?>
	<?php endif; ?>
	<?php if (is_active_sidebar('sidebar-3')) : ?>
		<?php dynamic_sidebar('sidebar-1'); ?>
	<?php endif; ?>
</div>


<footer id="colophon" class="site-footer">
	<div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'webstart')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'webstart'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'webstart'), 'webstart', '<a href="http://underscores.me/">Kosuke Takebayashi</a>');
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
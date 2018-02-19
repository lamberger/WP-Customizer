<?php
/**
 * Template Name: Front Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Informer
 */

get_header(); ?>
<?php if (get_theme_mod('pjl-message-show') == 'Yes') { ?>
<div class="pjl-message clearfix">
	<div class="pjl-message-img">
		<img src="<?php echo wp_get_attachment_url( get_theme_mod('pjl-message-img')) ?>">
	</div>
	<div class="pjl-message-text">
		<h3><a href="<?php echo get_permalink(get_theme_mod('pjl-message-link')) ?>"><?php echo get_theme_mod('pjl-message-headline')?></a></h3>
		<?php echo wpautop(get_theme_mod('pjl-message-txt')) ?>
	</div>
</div>
<?php } ?>
<?php get_footer();?>
<?php get_header(); ?>
<div class="row">
	<div class="twelve columns centered">
	<div class="alert-box error">404!</div>

	<p> <?php _e('La página no ha sido encontrada','evoratecwpf3'); ?></p>
	<p>Why don't you try a search?</p>
	
	<?php get_search_form(); ?>
	
	<a href="<?php echo home_url( '/' ); ?>">&larr; Go Home?</a>
</div>

		
<?php get_footer(); ?>
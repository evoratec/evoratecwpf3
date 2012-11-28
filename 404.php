<?php get_header(); ?>
<div class="row">
	<div class="twelve columns centered">
	<div class="alert-box error">404!</div>

	<p> <?php _e('La página no ha sido encontrada','evoratecwpf3'); ?></p>
	<p><?php _e('¿ Has probado la búsqueda ?','evoratecwpf3'); ?></p>
	
	<?php get_search_form(); ?>
	
	<a href="<?php echo home_url( '/' ); ?>">&larr; <?php _e('¿ Ir a inicio ?','evoratecwpf3'); ?></a>
</div>

		
<?php get_footer(); ?>
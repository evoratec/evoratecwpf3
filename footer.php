	</div><!-- Main Row-->

	<!-- Footer -->
	
	<div id="row-footer">
	    <div class="row">
	
            <footer>
                <?php // evora_footer(); ?>

                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sidebar')) : ?>

                <?php endif; ?>

           </footer>
	
	    </div><!-- Footer -->
	</div><!-- Footer -->
	
	
	</div><!-- container -->

	<!-- Incluidos JS Files -->	


	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.reveal.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.orbit-1.4.0.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.customforms.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.placeholder.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/jquery.tooltips.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/app.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/javascripts/menu.js"></script>


	
	<?php wp_footer(); ?>
	
</body>
</html>